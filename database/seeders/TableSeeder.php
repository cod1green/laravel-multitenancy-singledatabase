<?php

namespace Database\Seeders;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run()
    {
       Table::factory()
           ->count(9)
           ->for(Tenant::first())
           ->create();
    }
}
