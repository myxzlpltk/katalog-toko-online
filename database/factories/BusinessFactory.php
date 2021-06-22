<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'business_type_id' => $this->faker->numberBetween(1, 32),
			'teacher_id' => 1,
			'name' => trim($this->faker->sentence(4), '.'),
			'description' => $this->faker->text,
			'logo' => $this->faker->file(
				storage_path('faker/logos'),
				public_path('storage/logos'),
				false
			),
			'tagline' => $this->faker->sentence,
        ];
    }
}
