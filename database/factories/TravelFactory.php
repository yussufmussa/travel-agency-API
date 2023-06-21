<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use fake\Factory as fake;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travels>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(maxNbChars:20),
            'is_public' => fake()->boolean(),
            'description' => fake()->text(maxNbChars: 100),
            'number_of_days' => rand(1,10)
        ];
    }
}
