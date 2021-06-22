<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DosenDataTable;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DosenController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DosenDataTable $dataTable){
    	return $dataTable->render('admin.dosens.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(){
        return view('admin.dosens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request){
        $request->validate([
        	'nidn' => ['required', Rule::unique(Dosen::class)],
			'name' => 'required|string|max:255',
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
			'password' => 'required|string|min:8',
		]);

		$dosen = new Dosen();
		$dosen->nidn = $request->nidn;
		$dosen->save();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'dosen';
		$user->email_verified_at = now();
		$user->userable()->associate($dosen);
        $user->save();

        return redirect()->route('admin.dosens.index')->with('success', 'Data telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Dosen $dosen){
        return view('admin.dosens.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Dosen $dosen){
		$request->validate([
			'nidn' => ['required', Rule::unique(Dosen::class)->ignoreModel($dosen)],
			'name' => 'required|string|max:255',
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignoreModel($dosen->user)],
		]);

		$dosen->nidn = $request->nidn;
		$dosen->save();

		$dosen->user->name = $request->name;
		$dosen->user->email = $request->email;
		$dosen->user->save();

		return redirect()->route('admin.dosens.index')->with('success', 'Data telah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(Dosen $dosen){
		$dosen->delete();

		return redirect()->back()->with('success', 'Data telah dihapus.');
    }
}
