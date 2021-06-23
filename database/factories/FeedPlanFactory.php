<?php

namespace Database\Factories;

use App\Models\FeedPlan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedPlanFactory extends Factory
{

	private static $order = 0;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeedPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
    	$index = self::$order++;
    	$index = $index % 5 + 1;

        return [
			'feed_index' => $index,
			'plan_date' => Carbon::parse($this->faker->dateTimeThisMonth())->addWeeks($index),
			'topic' => $this->faker->sentence,
			'content' => $this->faker->paragraph,
			'brief_image' => $this->faker->file(
				storage_path('faker/briefs'),
				public_path('storage/briefs'),
				false
			),
			'caption' => $this->faker->paragraph,
			'headline' => $this->faker->paragraph,
        ];
    }
}
