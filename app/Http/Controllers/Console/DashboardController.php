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
		elseif($user->is_teacher){
			return view('console.teacher-dashboard', compact('user'));
		}
		elseif($user->is_student){
        	$feedPlans = $user->userable->business->feedPlans()
				->with('designs')
				->orderByDesc('plan_date')
				->limit(6)
				->get();

			return view('console.student-dashboard', compact('user', 'feedPlans'));
		}
        else{
        	abort(403);
		}
    }

}
