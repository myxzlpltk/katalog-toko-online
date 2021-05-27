<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ShopCollection;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;

class HomeController extends Controller{

	public function index(Request $request){
		$categories = Category::all();
		$categories->each(function ($category){
			$category->favoriteShops = $category->shops()
				->with('category')
				->withCount('public_reviews')
				->withMax('photos', 'file')
				->withAvg('public_reviews', 'rating')
				->orderByDesc('public_reviews_count')
				->orderByDesc('public_reviews_avg_rating')
				->limit(3)
				->get();
		});

		if($request->wantsJson()){
			return new ShopCollection($categories->pluck('favoriteShops')->collapse()->sortByDesc(function (Shop $shop){
				return $shop->public_reviews_avg_rating;
			}));
		}
		else{
			return view('home', compact('categories'));
		}
	}

	public function getCategories(Request $request){
		if($request->wantsJson()){
			return new CategoryCollection(Category::all());
		}
		else{
			abort(404);
		}
	}

}
