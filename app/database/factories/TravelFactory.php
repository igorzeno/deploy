<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
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
        $type = fake()->randomElement(['I', 'B']);
        $name = $type == "I" ? fake()->name() : fake()->company();

        return [
            'name' => $name,
            'is_public' => fake()->boolean(),
            'type' => $type,
            'number_of_days' => rand(6,14),
        ];
    }
}
