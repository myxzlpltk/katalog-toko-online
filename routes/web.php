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

Route::prefix('console/')->middleware(['auth', 'can:is-admin'])->group(function (){
	Route::redirect('/', 'console/dasbor');
    Route::get('dasbor', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('profil', [Admin\ProfileController::class, 'index'])->name('admin.profile');

    Route::resource('shops', Admin\ShopController::class, ['as' => 'admin']);

    Route::resource('business-fields', Admin\BusinessFieldController::class, ['as' => 'admin'])->except('show');
    Route::resource('business-fields.business-types', Admin\BusinessTypeController::class, ['as' => 'admin'])->shallow()->except('show');

    Route::resource('teachers', Admin\TeacherController::class, ['as' => 'admin'])->except('show');
});
