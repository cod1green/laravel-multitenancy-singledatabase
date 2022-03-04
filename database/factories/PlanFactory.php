<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->unique()->word,
            'stripe_id' => $this->faker->uuid(),
            'description' => $this->faker->realText(),
            'url' => $this->faker->slug(),
            'price' => $this->faker->randomFloat(2, 0, 200)
        ];
    }
}
