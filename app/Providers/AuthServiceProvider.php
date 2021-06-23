<?php

namespace App\Providers;

use App\Models\BusinessField;
use App\Models\BusinessType;
use App\Models\Teacher;
use App\Models\Shop;
use App\Models\User;
use App\Policies\BusinessFieldPolicy;
use App\Policies\BusinessTypePolicy;
use App\Policies\TeacherPolicy;
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
    	BusinessField::class => BusinessFieldPolicy::class,
		BusinessType::class => BusinessTypePolicy::class,
		Teacher::class => TeacherPolicy::class,
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
