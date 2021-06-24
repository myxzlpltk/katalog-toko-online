<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPolicy{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user){
        return $user->is_admin
			|| $user->is_teacher
			|| ($user->is_student && $user->userable->business_id != null);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return mixed
     */
    public function view(User $user, Business $business){
		return $user->is_admin
			|| ($user->is_teacher && $user->userable_id == $business->teacher_id)
			|| ($user->is_student && $user->userable->business_id == $business->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user){
        return $user->is_student && $user->userable->business_id == null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return mixed
     */
    public function update(User $user, Business $business){
        return $user->is_student && $user->userable->business_id == $business->id && $user->userable->validated_at != null;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return mixed
     */
    public function delete(User $user, Business $business){
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return mixed
     */
    public function restore(User $user, Business $business){
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return mixed
     */
    public function forceDelete(User $user, Business $business){
        //
    }

	/**
	 * Determine whether user is
	 * @param User $user
	 * @param Business $business
	 * @return bool
	 */
	public function isOwner(User $user, Business $business){
    	return $user->is_student && $user->userable_id == $business->owner_id;
	}

	/**
	 * Determine whether user can toggle invitation code
	 *
	 * @param User $user
	 * @param Business $business
	 * @return bool
	 */
	public function toggleInvitation(User $user, Business $business){
		return $user->is_student && $user->userable_id == $business->owner_id;
	}

	/**
	 * Determine whether student can join business
	 *
	 * @param User $user
	 * @param Business $business
	 * @return bool
	 */
	public function joinInvitation(User $user, Business $business){
    	return $user->is_student && $user->userable->business_id == null;
	}

	/**
	 * Determine whether the user can accept member from the model
	 *
	 * @param User $user
	 * @param Business $business
	 * @param Student $student
	 * @return mixed
	 */
	public function acceptMember(User $user, Business $business, Student $student){
		return $student->id != $business->owner_id && $user->userable_id == $business->owner_id && $student->validated_at == null;
	}

	/**
	 * Determine whether the user can unlink member from the model
	 *
	 * @param User $user
	 * @param Business $business
	 * @param Student $student
	 * @return mixed
	 */
	public function deleteMember(User $user, Business $business, Student $student){
		return $student->id != $business->owner_id && $user->userable_id == $business->owner_id;
	}
}
