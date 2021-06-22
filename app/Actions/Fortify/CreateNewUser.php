<?php

namespace App\Actions\Fortify;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
			'nim' => ['required', 'numeric', Rule::unique(Student::class)],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

		$student = new Student();
		$student->nim = $input['nim'];
		$student->save();

		$user = new User();
		$user->name = $input['name'];
		$user->email = $input['email'];
		$user->password = Hash::make($input['password']);
		$user->role = 'student';
		$user->userable()->associate($student);
		$user->save();

		return $user;
    }
}
