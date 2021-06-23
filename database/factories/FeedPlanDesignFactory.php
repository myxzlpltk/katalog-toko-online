<?php

namespace Database\Factories;

use App\Models\FeedPlanDesign;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedPlanDesignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeedPlanDesign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'design' => $this->faker->file(
				storage_path('faker/designs'),
				public_path('storage/designs'),
				false
			),
        ];
    }
}
