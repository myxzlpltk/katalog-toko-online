<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessPhoto;
use Illuminate\Http\Request;

class BusinessPhotoController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Business $business){
		$this->authorize('create', [BusinessPhoto::class, $business]);

		return view('console.business-photos.create', compact('business'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\JsonResponse
	 */
    public function store(Request $request, Business $business){
		$this->authorize('create', [BusinessPhoto::class, $business]);

		$request->validate([
			'file' => 'required|image|max:2048'
		]);

		$path = $request->file('file')->store('photos');

		$businessPhoto = new BusinessPhoto();
		$businessPhoto->file = basename($path);
		$business->photos()->save($businessPhoto);

		return response()->json(['file' => $path]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business, BusinessPhoto $businessPhoto){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business, BusinessPhoto $businessPhoto){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business, BusinessPhoto $businessPhoto){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(Business $business, BusinessPhoto $businessPhoto){
		$this->authorize('delete', $businessPhoto);

		$businessPhoto->delete();

		return redirect()->back()->with('success', 'Data telah dihapus.');
    }
}
