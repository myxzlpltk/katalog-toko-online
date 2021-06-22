<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller{

	public function dashboard(Request $request){
		if($request->user()->is_admin){
			return redirect()->route('admin.dashboard');
		}
	}
}
