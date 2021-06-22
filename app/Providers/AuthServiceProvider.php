<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Teacher;
use App\Models\Photo;
use App\Models\Review;
use App\Models\Shop;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\TeacherPolicy;
use App\Policies\PhotoPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\ShopPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
		Teacher::class => TeacherPolicy::class,
		Photo::class => PhotoPolicy::class,
		Review::class => ReviewPolicy::class,
		Shop::class => ShopPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

		Gate::define('is-admin', function (User $user) {
			return $user->is_admin;
		});
    }
}
