<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin/')->name('admin.')->group(function (){
    Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [Admin\ProfileController::class, 'index'])->name('profile');
});
