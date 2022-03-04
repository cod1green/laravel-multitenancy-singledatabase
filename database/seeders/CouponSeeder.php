<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(
            function ($tenant) {
                Coupon::factory()->count(1)->for($tenant)->create();

                Coupon::factory()
                    ->make(
                        [
                            'tenant_id' => $tenant,
                            'code' => 'ABC123',
                            'type' => 'percent',
                            'value' => 50
                        ]
                    )->save();

                Coupon::factory()
                    ->make(
                        [
                            'tenant_id' => $tenant,
                            'code' => 'DEF456',
                            'type' => 'fixed',
                            'value' => 1000
                        ]
                    )->save();
            }
        );
    }
}
