<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(Request $request){
        return view('admin.dashboard');
    }

}
