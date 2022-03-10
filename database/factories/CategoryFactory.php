<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tenant = Tenant::first();

        $name = $this->faker->unique()->word();

        return [
            'uuid' => $this->faker->uuid(),
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' => $this->faker->randomElement(['fa fa-user', 'fa fa-home']),
            'description' => $this->faker->sentence(3, true),
            'tenant_id' => $tenant ?? Tenant::factory()->create()
        ];
    }
}
