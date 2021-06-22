<?php

namespace App\Providers;

use App\Models\Dosen;
use App\Models\Photo;
use App\Models\Review;
use App\Models\Shop;
use App\Observers\DosenObserver;
use App\Observers\PhotoObserver;
use App\Observers\ReviewObserver;
use App\Observers\ShopObserver;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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

		/* Blade */
		Blade::directive('confirmation', function (){
			return 'onclick="return window.confirm(\'Apakah anda yakin?\')"';
		});

		/* Observer */
		Dosen::observe(DosenObserver::class);
		Photo::observe(PhotoObserver::class);
		Review::observe(ReviewObserver::class);
		Shop::observe(ShopObserver::class);
    }
}
