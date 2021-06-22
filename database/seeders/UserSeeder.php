<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
		User::factory()->create(['email' => 'admin@gmail.com']);
		User::factory()->for(
			Teacher::factory(), 'userable'
		)->create(['role' => 'teacher', 'email' => 'teacher@gmail.com']);
		User::factory()->for(
			Student::factory(), 'userable'
		)->create(['role' => 'student', 'email' => 'student@gmail.com']);
    }
}
