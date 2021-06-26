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
Route::get('toko/pencarian', [BusinessController::class, 'search'])->name('businesses.search');
Route::get('toko/{business:slug}', [BusinessController::class, 'view'])->name('businesses.view');

Route::prefix('console/')->middleware(['auth', 'verified'])->group(function (){
	Route::redirect('/', 'console/dasbor');
    Route::get('dasbor', [Console\DashboardController::class, 'index'])->name('console.dashboard');
    Route::get('profil', [Console\ProfileController::class, 'index'])->name('console.profile');

    Route::get('businesses/invite', [Console\BusinessController::class, 'invite'])->name('console.businesses.invite');
	Route::get('businesses/{business}/toggle-invitation', [Console\BusinessController::class, 'toggleInvitation'])->name('console.businesses.toggle-invitation');
	Route::patch('businesses/{business}/accept-member/{member}', [Console\BusinessController::class, 'acceptMember'])->name('console.businesses.accept-member');
    Route::delete('businesses/{business}/delete-member/{member}', [Console\BusinessController::class, 'deleteMember'])->name('console.businesses.delete-member');
    Route::resource('businesses', Console\BusinessController::class, ['as' => 'console']);

	Route::resource('businesses.feed-plans', Console\FeedPlanController::class, ['as' => 'console'])->shallow();
	Route::resource('feed-plans.feed-plan-designs', Console\FeedPlanDesignController::class, ['as' => 'console'])->shallow()->only('create', 'store', 'destroy');

    Route::resource('business-fields', Console\BusinessFieldController::class, ['as' => 'console'])->except('show');
    Route::resource('business-fields.business-types', Console\BusinessTypeController::class, ['as' => 'console'])->shallow()->except('show');

    Route::resource('teachers', Console\TeacherController::class, ['as' => 'console'])->except('show');

	Route::resource('students', Console\StudentController::class, ['as' => 'console'])->only('index', 'destroy');
});
