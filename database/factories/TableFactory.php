<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Table::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => 'Mesa ' . $this->faker->numerify('#'),
            'url' => $this->faker->slug(),
            'description' => $this->faker->sentence(3, true),
            'tenant_id' => Tenant::first()
        ];
    }
}
