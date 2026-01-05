<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        $starting_date = fake()->dateTimeBetween('-1 year', '-1 week')->format('Y-m-d H:i:s');
        $travel_id = Travel::inRandomOrder()->value('id');
        $number_of_days = Travel::find($travel_id)->number_of_days;
        $ending_date = Carbon::parse($starting_date)->addDays($number_of_days)->format('Y-m-d H:i:s');
        $status = fake()->randomElement(['N', 'P', 'C']); //'new','pay','canceled'

        return [
            'travel_id' => $travel_id,
            'name' => fake()->words(3, true),
            'description' => implode(' ', [
                fake()->sentence(4),
                fake()->sentence(10),
                fake()->sentence(7)
            ]),
            'status' => $status,
            'starting_date' => $starting_date,
            'ending_date' => $ending_date,
            'price' => fake()->randomFloat(2,10,999),
        ];
    }
}
