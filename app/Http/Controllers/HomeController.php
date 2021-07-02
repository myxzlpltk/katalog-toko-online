<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class HomeController extends Controller{

	public function index(Request $request){
		$businesses = Business::with('businessType')
			->limit(12)
			->orderByDesc('id')
			->get();

		return view('home', compact('businesses'));
	}

}
