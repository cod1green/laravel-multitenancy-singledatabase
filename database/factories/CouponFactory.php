<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition()
    {
        $date = date('Y-m-d H:i:s');
        $code = $this->faker->unique()->word();
        $slug = Str::slug($code);

        return [
            'uuid' => $this->faker->uuid(),
            'tenant_id' => Tenant::first() ?? Tenant::factory()->create(),
            'code' => $code,
            'slug' => $slug,
            'type' => $this->faker->randomElement(['fixed', 'percent']),
            'value' => $this->faker->numberBetween(10, 50),
            'quantity' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->sentence(3, true),
            'start_validity' => $date,
            'end_validity' => $this->faker->dateTimeBetween('+1 week', '+6 month'),
            'active' => $this->faker->randomElement([true, false]),
        ];
    }
}
