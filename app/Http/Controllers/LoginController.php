<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{

	public function dashboard(Request $request){
		if($request->user()->is_admin){
			return redirect()->route('admin.dashboard');
		}
		elseif($request->user()->is_teacher){
			return redirect()->route('teacher.dashboard');
		}
		elseif($request->user()->is_student){
			return redirect()->route('student.dashboard');
		}
		else{
			Auth::logout();

			return redirect()->route('login');
		}
	}
}
