<?php

namespace App\Providers;

use App\Models\Business;
use App\Models\BusinessField;
use App\Models\BusinessPhoto;
use App\Models\BusinessType;
use App\Models\FeedPlan;
use App\Models\FeedPlanDesign;
use App\Models\Student;
use App\Models\Teacher;
use App\Observers\BusinessFieldObserver;
use App\Observers\BusinessObserver;
use App\Observers\BusinessPhotoObserver;
use App\Observers\BusinessTypeObserver;
use App\Observers\FeedPlanDesignObserver;
use App\Observers\FeedPlanObserver;
use App\Observers\StudentObserver;
use App\Observers\TeacherObserver;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
		View::composer('layouts.public.app', function ($view){
			$view->with('businessTypes', BusinessType::query()->orderBy('name')->get());
		});

		/* Observer */
		Business::observe(BusinessObserver::class);
		BusinessField::observe(BusinessFieldObserver::class);
		BusinessPhoto::observe(BusinessPhotoObserver::class);
		BusinessType::observe(BusinessTypeObserver::class);
		FeedPlan::observe(FeedPlanObserver::class);
		FeedPlanDesign::observe(FeedPlanDesignObserver::class);
		Student::observe(StudentObserver::class);
		Teacher::observe(TeacherObserver::class);
    }
}
