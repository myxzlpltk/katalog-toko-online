<?php

namespace App\Http\Controllers\Console;

use App\DataTables\BusinessDataTable;
use App\DataTables\Scopes\TeacherFilter;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessField;
use App\Models\BusinessType;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class BusinessController extends Controller{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function index(BusinessDataTable $dataTable, Request $request){
		$this->authorize('view-any', Business::class);

		if($request->user()->is_teacher){
			$dataTable->addScope(new TeacherFilter($request->user()->userable));
		}

		return $dataTable->render('console.businesses.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function create(){
		$this->authorize('create', Business::class);

		$businessFields = BusinessField::query()
			->with('businessTypes')
			->has('businessTypes')
			->orderBy('name')
			->get();
		$teachers = Teacher::query()
			->with('user')
			->has('user')
			->get()
			->sortBy('user.name');

		return view('console.businesses.create', compact('businessFields', 'teachers'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request){
		$this->authorize('create', Business::class);

		$request->validate([
			'name' => 'required|string|max:255',
			'business_type_id' => ['required', Rule::exists(BusinessType::class, 'id')],
			'teacher_id' => ['required', Rule::exists(Teacher::class, 'id')],
			'description' => 'required|string',
			'tagline' => 'required|string|max:255',
			'logo' => 'nullable|image|max:2048',
		]);

		$business = new Business();
		$business->name = $request->name;
		$business->owner_id = $request->user()->userable_id;
		$business->business_type_id = $request->business_type_id;
		$business->teacher_id = $request->teacher_id;
		$business->description = $request->description;
		$business->tagline = $request->tagline;

		if($request->file('logo')){
			$image = Image::make($request->file('logo'));
			$dim = min($image->width(), $image->height(), 500);

			$business->logo = Str::random(64).'.jpg';
			Storage::put("logos/$business->logo", $image->fit($dim)->encode('jpg', 80));
		}

		$business->save();

		$request->user()->userable->business_id = $business->id;
		$request->user()->userable->validated_at = now();
		$request->user()->userable->save();

		return redirect()->route('console.businesses.show', $business)->with('success', 'Data telah ditambahkan.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Business  $business
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function show(Business $business){
		$this->authorize('view', $business);

		$business->load(['businessType.businessField', 'teacher.user', 'members.user']);

		return view('console.businesses.view', compact('business'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Business  $business
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function edit(Business $business){
		$this->authorize('update', $business);

		$businessFields = BusinessField::query()
			->with('businessTypes')
			->has('businessTypes')
			->orderBy('name')
			->get();
		$teachers = Teacher::query()
			->with('user')
			->has('user')
			->get()
			->sortBy('user.name');

		return view('console.businesses.edit', compact('businessFields', 'teachers', 'business'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Business  $business
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, Business $business){
		$this->authorize('update', $business);

		$request->validate([
			'name' => 'required|string|max:255',
			'business_type_id' => ['required', Rule::exists(BusinessType::class, 'id')],
			'teacher_id' => ['required', Rule::exists(Teacher::class, 'id')],
			'description' => 'required|string',
			'tagline' => 'required|string|max:255',
			'logo' => 'nullable|image|max:2048',
		]);

		$business->name = $request->name;
		$business->business_type_id = $request->business_type_id;
		$business->teacher_id = $request->teacher_id;
		$business->description = $request->description;
		$business->tagline = $request->tagline;

		if($request->file('logo')){
			$image = Image::make($request->file('logo'));
			$dim = min($image->width(), $image->height(), 500);

			$business->logo = Str::random(64).'.jpg';
			Storage::put("logos/$business->logo", $image->fit($dim)->encode('jpg', 80));
		}

		$business->save();

		return redirect()->route('console.businesses.show', $business)->with('success', 'Data telah diperbarui.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Business  $business
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Business $business){
		$this->authorize('delete', $business);

		$business->delete();

		return redirect()->route('console.businesses.index')->with('success', 'Data telah dihapus.');
	}

	public function toggleInvitation(Business $business){
		$this->authorize('toggle-invitation', $business);

		if($business->invitation_code){
			$business->invitation_code = null;
			$business->save();

			return redirect()->back()->with('success', 'Kode undangan telah dibatalkan.');
		}
		else{
			do{
				$code = strtolower(Str::random(10));
			} while(Business::query()->where('invitation_code', $code)->exists());

			$business->invitation_code = $code;
			$business->save();

			return redirect()->back()->with('success', 'Kode undangan telah dibuat.');
		}
	}

	/**
	 * Accept invitation link from business
	 *
	 * @param Request $request
	 */
	public function invite(Request $request){
		$business = Business::query()
			->whereNotNull('invitation_code')
			->where('invitation_code', $request->code)
			->firstOrFail();

		$this->authorize('join-invitation', $business);

		if($request->process == true){
			$request->user()->userable->business_id = $business->id;
			$request->user()->userable->save();

			return redirect()->route('console.dashboard')->with('success', 'Undangan sedang diproses. Minta ketua tim untuk menerima permintaanmu.');
		}
		else{
			return view('console.businesses.accept-invitation', compact('business'));
		}
	}

	/**
	 * Accept member request
	 *
	 * @param Business $business
	 * @param Student $student
	 */
	public function acceptMember(Business $business, Student $student){
		$this->authorize('accept-member', [$business, $student]);

		$student->validated_at = now();
		$student->save();

		return redirect()->back()->with('success', 'Anggota baru telah diterima');
	}

	/**
	 * Delete member link from business
	 *
	 * @param Business $business
	 * @param Student $student
	 */
	public function deleteMember(Business $business, Student $student){
		$this->authorize('delete-member', [$business, $student]);

		$student->business_id = null;
		$student->save();

		return redirect()->back()->with('success', 'Anggota berhasil dihapus.');
	}
}
