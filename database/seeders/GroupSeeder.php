<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $g1 = Group::create(['name' => 'VIP', 'description' => 'Grupo para o plano VIP']);
        $g1->plans()->attach([1]);

        $g2 = Group::create(['name' => 'PRO', 'description' => 'Grupo para o plano PRO']);
        $g2->plans()->attach([2]);

        $g3 = Group::create(['name' => 'Business', 'description' => 'Grupo para o plano Negócio']);
        $g3->plans()->attach([3]);

        $g4 = Group::create(['name' => 'Enterprise', 'description' => 'Grupo para o plano Empresarial']);
        $g4->plans()->attach([4]);
    }
}
