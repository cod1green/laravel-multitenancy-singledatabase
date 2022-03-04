<?php

namespace Database\Factories;

use App\Models\FormPayment;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FormPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::first() ?? Tenant::factory()->create(),
            "uuid" => $this->faker->uuid(),
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(3, true),
        ];
    }
}
