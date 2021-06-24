<?php

namespace App\Policies;

use App\Models\FeedPlan;
use App\Models\FeedPlanDesign;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPlanDesignPolicy{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user){
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return mixed
     */
    public function view(User $user, FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, FeedPlan $feedPlan){
		return $user->is_student && $user->userable->business_id == $feedPlan->business_id && $user->userable->validated_at != null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return mixed
     */
    public function update(User $user, FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return mixed
     */
    public function delete(User $user, FeedPlanDesign $feedPlanDesign){
		return $user->is_student && $user->userable->business_id == $feedPlanDesign->feedPlan->business_id && $user->userable->validated_at != null;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return mixed
     */
    public function restore(User $user, FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return mixed
     */
    public function forceDelete(User $user, FeedPlanDesign $feedPlanDesign){
        //
    }
}
