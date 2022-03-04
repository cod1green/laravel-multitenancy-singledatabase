<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $r1 = Role::create(['id' => 1, 'name' => 'SASS', 'description' => 'Gerenciar o SASS']);
        $r2 = Role::create(['id' => 2, 'name' => 'Administrador', 'description' => 'Administrador da empresa']);
        $r3 = Role::create(['name' => 'Entregador', 'description' => 'Entregador da empresa']);
        $r4 = Role::create(['name' => 'Gerente', 'description' => 'Gerente da empresa']);
        $r5 = Role::create(['name' => 'Caixa', 'description' => 'Caixa da empresa']);
        $r6 = Role::create(['name' => 'Garçon', 'description' => 'Garçon da empresa']);
        $r7 = Role::create(['name' => 'Cozinheiro', 'description' => 'Cozinheiro da empresa']);
        $r8 = Role::create(['name' => 'Vendedor', 'description' => 'Vendedor da empresa']);
        $r9 = Role::create(['name' => 'Estoque', 'description' => 'Estoque da empresa']);

        User::first()->roles()->attach([$r1->id]);
        User::skip(1)->first()->roles()->attach([$r2->id]);
    }
}
