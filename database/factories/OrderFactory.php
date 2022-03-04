<?php

namespace Database\Factories;

use App\Models\FormPayment;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $tenant = Tenant::first();
        $payment = FormPayment::first();

        return [
            'tenant_id' => $tenant ?? Tenant::factory()->create(),
            'form_payment_id' => $payment ?? FormPayment::factory()->create(),
            'identify' => uniqid('', true) . Str::random(10),
            'address' => $this->faker->address(),
            'total_paid' => 60.0,
            'total_discount' => 20.0,
            'total' => 80.0,
            'status' => 'open',
        ];
    }
}
