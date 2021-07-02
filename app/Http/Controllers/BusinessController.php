<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessType;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BusinessController extends Controller{

	public function view(Request $request, Business $business){
		$business->load([
			'businessType.businessField',
			'activeMembers' => function($query) use($business){
				return $query
					->with(['user' => function($query){
						return $query->without('userable');
					}])
					->where('id', '!=', $business->owner_id);
			},
			'owner.user' => function($query){
				return $query->without('userable');
			},
			'teacher.user' => function($query){
				return $query->without('userable');
			},
			'photos'
		]);

		SEOTools::setDescription("Informasi toko {$business->name}");

		SEOTools::opengraph()->addProperty('type', 'businesses');
		SEOTools::opengraph()->setTitle($business->name);
		SEOTools::opengraph()->addImage($business->background_path);

		SEOTools::twitter()->setTitle($business->name);
		SEOTools::twitter()->setImage($business->background_path);

		SEOTools::jsonLd()->setTitle($business->name);
		SEOTools::jsonLd()->addImage($business->background_path);

		return view('businesses.view', compact('business'));
	}

	public function search(Request $request){
		try {
			$ids = Business::search($request->get('query'), function ($algolia, $query, $options) use ($request){
				$newOptions = [];

				if($request->business_type_id){
					$newOptions["facetFilters"] = "business-type-id:".$request->business_type_id;
				}

				return $algolia->search($query, array_merge($options, $newOptions));
			})->keys()->toArray();
		} catch(\Exception $e){
			$ids = Business::query()
				->where('name', 'like', "%{$request->get('query')}%")
				->where(function (Builder $query) use ($request){
					if($request->business_type_id){
						$query->where('business_type_id', $request->business_type_id);
					}
				})
				->pluck('id')->toArray();
		}

		$businesses = Business::with('businessType')
			->whereIn('id', $ids)
			->paginate(24)
			->appends([
				'query' => $request->get('query'),
				'business_type_id' => $request->get('business_type_id'),
				'sort' => $request->get('sort'),
			]);
		$businessTypes = BusinessType::with('businessField')->orderBy('name')->get();

		return view('businesses.search', compact('businesses', 'businessTypes'));
	}
}
