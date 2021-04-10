<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller{

	public function view(Shop $shop){
		$shop->loadCount('reviews')
			->loadMax('photos', 'file')
			->loadAvg('reviews', 'rating');

		return view('shops.view', compact('shop'));
	}
}
