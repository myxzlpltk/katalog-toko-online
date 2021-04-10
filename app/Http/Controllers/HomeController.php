<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller{

	public function index(Request $request){
		$categories = Category::all();
		$categories->each(function ($category){
			$category->favoriteShops = $category->shops()
				->withCount('public_reviews')
				->withMax('photos', 'file')
				->withAvg('public_reviews', 'rating')
				->orderByDesc('public_reviews_count')
				->orderByDesc('public_reviews_avg_rating')
				->limit(3)
				->get();
		});

		return view('home', compact('categories'));
	}

}
