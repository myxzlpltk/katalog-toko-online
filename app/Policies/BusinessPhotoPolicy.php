<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\BusinessPhoto;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPhotoPolicy{

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
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return mixed
     */
    public function view(User $user, BusinessPhoto $businessPhoto){
        //
    }

	/**
	 * Determine whether the user can create models.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Business $business
	 * @return mixed
	 */
    public function create(User $user, Business $business){
		return $user->is_student && $user->userable->business_id == $business->id && $user->userable->validated_at != null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return mixed
     */
    public function update(User $user, BusinessPhoto $businessPhoto){
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return mixed
     */
    public function delete(User $user, BusinessPhoto $businessPhoto){
		return $user->is_student && $user->userable->business_id == $businessPhoto->business_id && $user->userable->validated_at != null;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return mixed
     */
    public function restore(User $user, BusinessPhoto $businessPhoto){
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return mixed
     */
    public function forceDelete(User $user, BusinessPhoto $businessPhoto){
        //
    }
}
