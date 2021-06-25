<?php

namespace App\Actions\Fortify;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation{

    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input){
    	$rules = [
			'name' => ['required', 'string', 'max:255'],
			'email' => [
				'required',
				'string',
				'email',
				'max:255',
				Rule::unique('users')->ignore($user->id),
			],
		];

    	if($user->is_student) $rules['nim'] = ['required', 'string', 'max:255', Rule::unique(Student::class)->ignoreModel($user->userable)];
		if($user->is_teacher) $rules['nidn'] = ['required', 'string', 'max:255', Rule::unique(Teacher::class)->ignoreModel($user->userable)];

        Validator::make($input, $rules)->validateWithBag('updateProfileInformation');

		if($user->is_student) $user->userable->forceFill(['nim' => $input['nim']])->save();
		if($user->is_teacher) $user->userable->forceFill(['nidn' => $input['nidn']])->save();

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input){
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
