<?php

namespace App\Providers;

use App\Models\Business;
use App\Models\BusinessField;
use App\Models\BusinessType;
use App\Models\FeedPlan;
use App\Models\FeedPlanDesign;
use App\Models\Teacher;
use App\Models\User;
use App\Policies\BusinessFieldPolicy;
use App\Policies\BusinessPolicy;
use App\Policies\BusinessTypePolicy;
use App\Policies\FeedPlanDesignPolicy;
use App\Policies\FeedPlanPolicy;
use App\Policies\TeacherPolicy;
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
    	Business::class => BusinessPolicy::class,
    	BusinessField::class => BusinessFieldPolicy::class,
		BusinessType::class => BusinessTypePolicy::class,
		FeedPlan::class => FeedPlanPolicy::class,
		FeedPlanDesign::class => FeedPlanDesignPolicy::class,
		Teacher::class => TeacherPolicy::class,
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

		Gate::define('is-teacher', function (User $user) {
			return $user->is_teacher;
		});

		Gate::define('is-student', function (User $user) {
			return $user->is_student;
		});
    }
}
