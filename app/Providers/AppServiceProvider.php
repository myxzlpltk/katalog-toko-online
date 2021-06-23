<?php

namespace App\Providers;

use App\Models\Business;
use App\Models\BusinessField;
use App\Models\BusinessType;
use App\Models\Teacher;
use App\Observers\BusinessFieldObserver;
use App\Observers\BusinessObserver;
use App\Observers\BusinessTypeObserver;
use App\Observers\TeacherObserver;
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
		Business::observe(BusinessObserver::class);
		BusinessField::observe(BusinessFieldObserver::class);
		BusinessType::observe(BusinessTypeObserver::class);
		Teacher::observe(TeacherObserver::class);
    }
}
