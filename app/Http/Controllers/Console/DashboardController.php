<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\FeedPlan;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(Request $request){
    	$user = $request->user();

        if($user->is_admin){
			return view('console.admin-dashboard');
		}
		elseif($user->is_teacher){
        	$businessIds = $user->userable->businesses()->pluck('id');
        	$feedPlans = FeedPlan::query()
				->whereIn('business_id', $businessIds)
				->orderByDesc('plan_date')
				->limit(6)
				->get();

			return view('console.teacher-dashboard', compact('user', 'feedPlans', 'businessIds'));
		}
		elseif($user->is_student){
        	if($user->userable->business && $user->userable->validated_at){
				$feedPlans = $user->userable->business->feedPlans()
					->with('designs')
					->orderByDesc('plan_date')
					->limit(6)
					->get();

				return view('console.student-dashboard', compact('user', 'feedPlans'));
			}
        	else{
				return view('console.student-dashboard', compact('user'));
			}
		}
        else{
        	abort(403);
		}
    }

}