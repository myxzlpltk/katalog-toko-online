<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\FeedPlan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPlanPolicy{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Business $business){
		return $user->is_admin
			|| ($user->is_teacher && $user->userable_id == $business->teacher_id)
			|| ($user->is_student && $user->userable->business_id == $business->id && $user->userable->validated_at != null);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return mixed
     */
    public function view(User $user, FeedPlan $feedPlan){
        return $user->is_admin
			|| ($user->is_teacher && $feedPlan->business->teacher_id == $user->userable_id)
			|| ($user->is_student && $feedPlan->business_id == $user->userable->business_id && $user->userable->validated_at != null);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, Business $business){
        return $user->is_student && $user->userable->business_id == $business->id && $user->userable->validated_at != null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return mixed
     */
    public function update(User $user, FeedPlan $feedPlan){
		return $user->is_student && $user->userable->business_id == $feedPlan->business_id && $user->userable->validated_at != null;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return mixed
     */
    public function delete(User $user, FeedPlan $feedPlan){
		return $user->is_student && $user->userable->business_id == $feedPlan->business_id && $user->userable->validated_at != null;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return mixed
     */
    public function restore(User $user, FeedPlan $feedPlan){
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return mixed
     */
    public function forceDelete(User $user, FeedPlan $feedPlan){
        //
    }
}
