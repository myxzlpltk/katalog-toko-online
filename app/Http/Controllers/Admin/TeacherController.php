<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TeacherDataTable;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TeacherDataTable $dataTable){
    	$this->authorize('view-any', Teacher::class);

    	return $dataTable->render('admin.teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(){
		$this->authorize('create', Teacher::class);

        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request){
		$this->authorize('create', Teacher::class);

        $request->validate([
        	'nidn' => ['required', Rule::unique(Teacher::class)],
			'name' => 'required|string|max:255',
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
			'password' => 'required|string|min:8',
		]);

		$teacher = new Teacher();
		$teacher->nidn = $request->nidn;
		$teacher->save();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher';
		$user->email_verified_at = now();
		$user->userable()->associate($teacher);
        $user->save();

        return redirect()->route('admin.teachers.index')->with('success', 'Data telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher){
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Teacher $teacher){
		$this->authorize('update', $teacher);

        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Teacher $teacher){
		$this->authorize('update', $teacher);

		$request->validate([
			'nidn' => ['required', Rule::unique(Teacher::class)->ignoreModel($teacher)],
			'name' => 'required|string|max:255',
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignoreModel($teacher->user)],
		]);

		$teacher->nidn = $request->nidn;
		$teacher->save();

		$teacher->user->name = $request->name;
		$teacher->user->email = $request->email;
		$teacher->user->save();

		return redirect()->route('admin.teachers.index')->with('success', 'Data telah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(Teacher $teacher){
		$this->authorize('delete', $teacher);

		$teacher->delete();

		return redirect()->back()->with('success', 'Data telah dihapus.');
    }
}
