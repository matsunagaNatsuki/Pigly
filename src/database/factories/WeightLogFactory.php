<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;
use App\Models\User;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    public function definition(): array
    {
        return [
            'user_id' => User::first()->id,
            'date' => $this->faker->dateTimeBetween('-40 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 50, 75),
            'calories' => $this->faker->numberBetween(1200, 2000),
            'exercise_time' => $this->faker->time('H:i'),
            'exercise_content' => $this->faker->realText(50),
        ];
    }
}
