<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(Request $request){
    	$user = $request->user();

        if($user->is_admin){
			return view('console.admin-dashboard');
		}
        elseif($user->is_student){
			return view('console.student-dashboard', compact('user'));
		}
        else{
        	abort(403);
		}
    }

}
