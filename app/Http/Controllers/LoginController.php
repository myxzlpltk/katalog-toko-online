<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{

	public function dashboard(Request $request){
		if($request->user()->is_admin){
			return redirect()->route('admin.dashboard');
		}
		elseif($request->user()->is_dosen){
			return redirect()->route('dosen.dashboard');
		}
		elseif($request->user()->is_mahasiswa){
			return redirect()->route('dosen.dashboard');
		}
		else{
			Auth::logout();

			return redirect()->route('login');
		}
	}
}
