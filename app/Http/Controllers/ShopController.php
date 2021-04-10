<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShopController extends Controller{

	public function view(Shop $shop){
		$shop->loadCount('public_reviews')
			->loadMax('photos', 'file')
			->loadAvg('public_reviews', 'rating');

		return view('shops.view', compact('shop'));
	}

	public function search(Request $request){
		$query = '%'.$request->get('query').'%';
		$builder = Shop::query()
			->where(function (Builder $builder) use ($query){
				$builder->orWhere('name', 'like', $query);
				$builder->orWhere('description', 'like', $query);
				$builder->orWhere('address', 'like', $query);
				$builder->orWhere('phone_number', 'like', $query);
			})
			->where(function (Builder $builder) use ($request){
				if($request->category_id){
					$builder->where('category_id', '=', $request->category_id);
				}
			})
			->where(function (Builder $builder) use ($request){
				if($request->min_price){
					$min_price = intval($request->min_price)*1000;

					$builder->where('max_price', '>=', $min_price);
					$builder->orWhereNull('max_price');
					$builder->orWhere('max_price', '=', 0);
				}
			})
			->withCount('public_reviews')
			->withMax('photos', 'file')
			->withAvg('public_reviews', 'rating')
			->with('category')
			->has('category');

		if($request->get('sort_rating') == 'asc'){
			$builder->orderBy('public_reviews_count');
			$builder->orderBy('public_reviews_avg_rating');
		}
		else{
			$builder->orderByDesc('public_reviews_count');
			$builder->orderByDesc('public_reviews_avg_rating');
		}

		$min_price = max($builder->clone()->max('min_price'), 0);
		$max_price = max($builder->clone()->max('max_price'), 0, $min_price);

		if($request->min_price && ($request->min_price > $max_price || $request->min_price < $min_price)){
			$request->min_price = $min_price;
		}

		$shops = $builder->paginate(24);
		$shops->appends([
			'query' => $request->get('query'),
			'category_id' => $request->get('category_id'),
			'sort_rating' => $request->get('sort_rating'),
			'min_price' => $request->get('min_price'),
		]);
		$categories = Category::all();

		return view('shops.search', compact('shops', 'categories', 'min_price', 'max_price'));
	}
}
