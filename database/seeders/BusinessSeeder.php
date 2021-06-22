<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::factory()->count(10)->create()->each(function (Business $business){
			$roles = ['owner', 'member', 'member', 'member'];

			foreach($roles as $role){
				$user = User::factory()->for(
					Student::factory(), 'userable'
				)->create(['role' => 'student']);

				$business->members()->attach($user->userable, ['role' => $role, 'is_valid' => true]);
			}
		});
    }
}
