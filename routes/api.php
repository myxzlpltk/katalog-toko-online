<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'getCategories']);
Route::get('/shops', [ShopController::class, 'search']);
Route::get('/shops/{shop}', [ShopController::class, 'view']);
Route::get('/shops/{shop}/reviews', [ShopController::class, 'getReviews']);
Route::post('/shops/{shop}/reviews', [ShopController::class, 'addReview']);
