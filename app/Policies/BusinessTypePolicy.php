<?php

namespace App\Policies;

use App\Models\BusinessType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessTypePolicy{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user){
		return $user->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessType  $businessType
     * @return mixed
     */
    public function view(User $user, BusinessType $businessType){
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user){
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessType  $businessType
     * @return mixed
     */
    public function update(User $user, BusinessType $businessType){
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessType  $businessType
     * @return mixed
     */
    public function delete(User $user, BusinessType $businessType){
        return $user->is_admin && $businessType->businesses_count == 0;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessType  $businessType
     * @return mixed
     */
    public function restore(User $user, BusinessType $businessType){
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessType  $businessType
     * @return mixed
     */
    public function forceDelete(User $user, BusinessType $businessType){
        //
    }
}
