<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'travel_id' => Travel::inRandomOrder()->take(10)->first()->id,
            'name' => fake()->text(maxNbChars: 10),
            'starting_day' => fake()->date(),
            'ending_date' => fake()->date(),
            'price' => (rand(100, 2000) * 100),
        ];
        
    }
}
