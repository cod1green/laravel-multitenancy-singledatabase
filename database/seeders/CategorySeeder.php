<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(
            fn($tenant) => Category::factory()->count(5)->for($tenant)->create()
        );
    }
}
