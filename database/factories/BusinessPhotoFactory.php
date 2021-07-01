<?php

namespace Database\Factories;

use App\Models\BusinessPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessPhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusinessPhoto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'file' => $this->faker->file(
				storage_path('faker/photos'),
				public_path('storage/photos'),
				false
			),
        ];
    }
}
