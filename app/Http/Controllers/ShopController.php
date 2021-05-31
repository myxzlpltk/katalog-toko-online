<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewCollection;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ShopCollection;
use App\Http\Resources\ShopResource;
use App\Models\Category;
use App\Models\Review;
use App\Models\Shop;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ShopController extends Controller{

	public function list(Request $request){
		$request->validate(['ids' => 'required|array']);

		$shops = Shop::query()
			->with('category')
			->has('category')
			->withCount('public_reviews')
			->withMax('photos', 'file')
			->withAvg('public_reviews', 'rating')
			->whereIn('id', $request->ids)
			->get();

		if($request->wantsJson()){
			return new ShopCollection($shops);
		}
		else{
			abort(404);
		}
	}

	public function view(Request $request, Shop $shop){
		$shop->load('category')
			->loadCount('public_reviews')
			->loadMax('photos', 'file')
			->loadAvg('public_reviews', 'rating');

		if($request->wantsJson()){
			return new ShopResource($shop->load([
				'photos',
				'public_reviews' => function(HasMany $query){
					$query->limit(3);
				}
			]));
		}
		else{
			SEOTools::setDescription("Informasi toko {$shop->name}");

			SEOTools::opengraph()->addProperty('type', 'shops');
			SEOTools::opengraph()->setTitle($shop->name);
			SEOTools::opengraph()->addImage(asset("storage/photos/{$shop->photos_max_file}"));

			SEOTools::twitter()->setTitle($shop->name);
			SEOTools::twitter()->setImage(asset("storage/photos/{$shop->photos_max_file}"));

			SEOTools::jsonLd()->setTitle($shop->name);
			SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

			return view('shops.view', compact('shop'));
		}
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

		$builder->where(function (Builder $builder) use ($request){
			if($request->min_price){
				$min_price = intval($request->min_price)*1000;

				$builder->where('max_price', '>=', $min_price);
				$builder->orWhereNull('max_price');
				$builder->orWhere('max_price', '=', 0);
			}
		});

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

		if($request->wantsJson()){
			return (new ShopCollection($shops))->additional([
				'min_price' => $min_price,
				'max_price' => $max_price
			]);
		}
		else{
			return view('shops.search', compact('shops', 'categories', 'min_price', 'max_price'));
		}
	}

	public function getReviews(Shop $shop, Request $request){
		if($request->wantsJson()){
			return new ReviewCollection($shop->public_reviews()->paginate(10));
		}
		else{
			abort(404);
		}
	}

	public function addReview(Shop $shop, Request $request){
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => [
				'required','string','max:255',
				Rule::unique(Review::class)->where('shop_id', $shop->id)
			],
			'review_text' => 'required|string',
			'rating' => 'required|integer|min:1,max:5',
		]);

		$review = new Review();
		$review->name = $request->name;
		$review->email = $request->email;
		$review->review_text = $request->review_text;
		$review->rating = $request->rating;
		$shop->reviews()->save($review);

		if($request->wantsJson()){
			return new ReviewResource($review);
		}
		else{
			return redirect()->route('shop.view', $shop);
		}
	}
}
