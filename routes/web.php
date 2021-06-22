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
Route::get('/categories', [HomeController::class, 'getCategories']);
Route::get('toko/pencarian', [ShopController::class, 'search'])->name('shops.search');
Route::get('toko/{shop:slug}', [ShopController::class, 'view'])->name('shops.view');
Route::post('toko/{shop:slug}/add-review', [ShopController::class, 'addReview'])->name('shops.add-review');

Route::get('dashboard', [LoginController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::prefix('admin/')->middleware('auth')->group(function (){
	Route::redirect('/', 'dasbor');
    Route::get('dasbor', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('profil', [Admin\ProfileController::class, 'index'])->name('admin.profile');

    Route::resource('shops', Admin\ShopController::class, ['as' => 'admin']);

	Route::resource('categories', Admin\CategoryController::class, ['as' => 'admin'])->except('show');

	Route::patch('shops.reviews/publish-all', [Admin\ReviewController::class, 'publishAll'])->name('admin.reviews.publish-all');
    Route::patch('shops.reviews/{review}/publish', [Admin\ReviewController::class, 'publish'])->name('admin.reviews.publish');
    Route::resource('shops.reviews', Admin\ReviewController::class, ['as' => 'admin'])->only('destroy')->shallow();

    Route::resource('shops.photos', Admin\PhotoController::class, ['as' => 'admin'])->only('create', 'store', 'destroy')->shallow();
});
