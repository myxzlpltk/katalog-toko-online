<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->randomElement([1, 2]),
            'name' => trim($this->faker->sentence(4), '.'),
            'description' => $this->faker->text,
            'logo' => $this->faker->file(
                storage_path('faker/logos'),
                storage_path('app/public/logos'),
                false
            ),
            'address' => $this->faker->address,
            'phone_number' => $this->faker->e164PhoneNumber,
            'min_price' => $this->faker->optional(0.75)->numberBetween(5, 10)*1000,
            'max_price' => $this->faker->optional(0.75)->numberBetween(50, 70)*1000,
            'monday_open' => $this->faker->optional(0.5)->time,
            'monday_close' => $this->faker->optional(0.5)->time,
            'tuesday_open' => $this->faker->optional(0.5)->time,
            'tuesday_close' => $this->faker->optional(0.5)->time,
            'wednesday_open' => $this->faker->optional(0.5)->time,
            'wednesday_close' => $this->faker->optional(0.5)->time,
            'thursday_open' => $this->faker->optional(0.5)->time,
            'thursday_close' => $this->faker->optional(0.5)->time,
            'friday_open' => $this->faker->optional(0.5)->time,
            'friday_close' => $this->faker->optional(0.5)->time,
            'saturday_open' => $this->faker->optional(0.5)->time,
            'saturday_close' => $this->faker->optional(0.5)->time,
            'sunday_open' => $this->faker->optional(0.5)->time,
            'sunday_close' => $this->faker->optional(0.5)->time,
        ];
    }
}
