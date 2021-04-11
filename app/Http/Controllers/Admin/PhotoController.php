<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Shop;
use Illuminate\Http\Request;

class PhotoController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Shop $shop){
        return view('admin.photos.create', compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\JsonResponse
	 */
    public function store(Request $request, Shop $shop){
        $request->validate([
        	'file' => 'required|image|max:2048'
		]);

        $path = $request->file('file')->store('photos');

        $photos = new Photo();
        $photos->file = basename($path);
        $shop->photos()->save($photos);

        return response()->json(['file' => $path]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Photo $photo){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Photo $photo){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Photo $photo){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(Shop $shop, Photo $photo){
        $photo->delete();

		return redirect()->back()->with('success', 'Data telah dihapus.');
    }
}
