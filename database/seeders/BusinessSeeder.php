<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\FeedPlan;
use App\Models\FeedPlanDesign;
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
    public function run(){
        Business::factory()
			->has(
				FeedPlan::factory()->count(5)->has(
					FeedPlanDesign::factory()->count(5), 'designs'
				)
			)
			->count(10)
			->create(['owner_id' => 1])
			->each(function (Business $business){
				$roles = ['owner', 'member', 'member', 'member'];

				foreach($roles as $role){
					$user = User::factory()->for(
						Student::factory()->state(['validated_at' => now(), 'business_id' => $business->id]), 'userable'
					)->create(['role' => 'student']);

					if($role == 'owner'){
						$business->update(['owner_id' => $user->userable_id]);
					}
				}
			});
    }
}
