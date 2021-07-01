<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller{

    public function index(Request $request){
        return view('console.profile', [
            'user' => $request->user()
        ]);
    }

}