<?php

namespace Database\Factories;

use App\Models\DetailPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'url' => $this->faker->slug(),
            'plan_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
