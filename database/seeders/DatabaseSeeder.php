<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(
            [
                PlanSeeder::class,
                TenantSeeder::class,
                UserSeeder::class,
                GroupSeeder::class,
                RoleSeeder::class,
                PermissionSeeder::class,

                CategorySeeder::class,
                ProductSeeder::class,
                CouponSeeder::class,
            ]
        );
    }
}
