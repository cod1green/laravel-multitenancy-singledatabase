<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $p1 = Permission::create(['name' => 'tenants', 'description' => 'Empresas']);
        $p2 = Permission::create(['name' => 'users', 'description' => 'Usuários']);
        $p3 = Permission::create(['name' => 'roles', 'description' => 'Funções']);
        $p4 = Permission::create(['name' => 'plans', 'description' => 'Planos']);
        $p5 = Permission::create(['name' => 'groups', 'description' => 'Grupos']);
        $p6 = Permission::create(['name' => 'permissions', 'description' => 'Permissões']);
        $p7 = Permission::create(['name' => 'products', 'description' => 'Produtos']);
        $p8 = Permission::create(['name' => 'categories', 'description' => 'Categorias']);
        $p9 = Permission::create(['name' => 'tables', 'description' => 'Mesas']);
        $p10 = Permission::create(['name' => 'orders', 'description' => 'Pedidos']);
        $p11 = Permission::create(['name' => 'dashboard', 'description' => 'Painel administrativo']);
        $p12 = Permission::create(['name' => 'debugs', 'description' => 'Depurar']);
        $p13 = Permission::create(['name' => 'commands', 'description' => 'Comandos']);
        $p14 = Permission::create(['name' => 'backups', 'description' => 'Backups']);
        $p15 = Permission::create(['name' => 'settings', 'description' => 'Configurações']);

        // Group::first()->permissions()->attach([1, 2, 6, 7, 8, 9, 10]);
        // Role::first()->permissions()->attach([1, 2, 6, 7, 8, 9, 10]);
    }
}
