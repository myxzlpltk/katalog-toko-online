<?php

namespace App\Providers;

use App\Models\Review;
use App\Observers\ReviewObserver;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Setup Locale ID */
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        /* Pagination */
		Paginator::useBootstrap();
    }
}
