<?php

namespace Database\Seeders;

use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class DetailPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plan = Plan::first();

        DetailPlan::factory()
            ->count(3)
            ->for($plan)
            ->create();
    }
}
