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
Route::get('toko/pencarian', [ShopController::class, 'search'])->name('shop.search');
Route::get('toko/{shop}', [ShopController::class, 'view'])->name('shop.view');
Route::post('toko/{shop}/add-review', [ShopController::class, 'addReview'])->name('shop.add-review');

Route::prefix('admin/')->middleware('auth')->group(function (){
    Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [Admin\ProfileController::class, 'index'])->name('admin.profile');
});
