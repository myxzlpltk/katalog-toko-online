<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Http\Request;

class ReviewController extends Controller{

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
     * @return \Illuminate\Http\Response
     */
    public function create(Shop $shop){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shop $shop){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Review $review){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Review $review){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Review $review){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(Shop $shop, Review $review){
        $review->delete();

        return redirect()->back()->with('success', 'Data telah dihapus.');
    }

	public function publishAll(Shop $shop, Review $review){
		Review::query()->whereNull('published_at')->update([
			'published_at' => now()
		]);

		return redirect()->back()->with('success', 'Semua review telah dipublish.');
	}

	public function publish(Shop $shop, Review $review){
    	$review->published_at = now();
    	$review->save();

		return redirect()->back()->with('success', 'Review telah dipublish.');
	}

}
