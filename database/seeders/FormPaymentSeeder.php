<?php

namespace Database\Seeders;

use App\Models\FormPayment;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class FormPaymentSeeder extends Seeder
{
    public function run(): void
    {
        FormPayment::factory()
            ->count(3)
            ->for(Tenant::first())
            ->create();
    }
}
