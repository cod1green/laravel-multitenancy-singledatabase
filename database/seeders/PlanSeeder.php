<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Plan::create(
            [
                'name' => 'VIP',
                'price' => 0.0,
                'description' => 'Plan VIP',
                'access' => 'private',
            ]
        );

        $p2 = Plan::create(
            [
                'name' => 'Basic',
                'price' => 399.90,
                'description' => 'Plan basic',
            ]
        );

        $p3 = Plan::create(
            [
                'name' => 'Premium',
                'price' => 599.90,
                'description' => 'Plan premium',
            ]
        );

        $p4 = Plan::create(
            [
                'name' => 'Pro',
                'price' => 799.90,
                'recommended' => true,
                'description' => 'Plan Pro',
            ]
        );

        $p5 = Plan::create(
            [
                'name' => 'Ultimate',
                'price' => 949.90,
                'description' => 'Plan ultimate',
            ]
        );
    }
}
