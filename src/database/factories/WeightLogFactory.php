<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'date' => $this->faker->dateTimeBetween('-40 days', 'now'),
            'weight' => $this->faker->randomFloat(1, 50, 90),
            'calories' => $this->faker->numberBetween(1200, 3000),
            'exercise_time' => $this->faker->numberBetween(0, 120),
        ];
    }
}
