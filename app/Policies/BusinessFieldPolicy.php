<?php

namespace App\Policies;

use App\Models\BusinessField;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessFieldPolicy{

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
     * @param  \App\Models\BusinessField  $businessField
     * @return mixed
     */
    public function view(User $user, BusinessField $businessField){
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
     * @param  \App\Models\BusinessField  $businessField
     * @return mixed
     */
    public function update(User $user, BusinessField $businessField){
		return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessField  $businessField
     * @return mixed
     */
    public function delete(User $user, BusinessField $businessField){
		return $user->is_admin && $businessField->business_types_count == 0;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessField  $businessField
     * @return mixed
     */
    public function restore(User $user, BusinessField $businessField){
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessField  $businessField
     * @return mixed
     */
    public function forceDelete(User $user, BusinessField $businessField){
        //
    }
}
