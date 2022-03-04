<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $plan = Plan::first();

        return [
            'uuid' => $this->faker->uuid(),
            'plan_id' => $plan ?? Plan::factory()->create(),
            'name' => $this->faker->unique()->name,
            'company' => $this->faker->unique()->company,
            'document' => $this->faker->cnpj(false),
            'phone' => $this->faker->phoneNumber(),
            'url' => $this->faker->url(),
            'email' => $this->faker->unique()->companyEmail,
        ];
    }
}
