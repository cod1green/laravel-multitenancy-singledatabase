<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->make(
                [
                    'tenant_id' => Tenant::first(),
                    'name' => 'Administrador',
                    'username' => 'admin',
                    'sex' => 'M',
                    'email' => config('admin.admin_email'),
                    'password' => config('admin.admin_password'),
                    'phone' => '(11) 99876-5432',
                    'birth' => '1988-07-29',
                    'bio' => 'Administrador do sistema',
                    'active' => true
                ]
            )->save();

        User::factory()
            ->make(
                [
                    'tenant_id' => Tenant::skip(1)->first(),
                    'name' => 'User',
                    'username' => 'user',
                    'sex' => 'M',
                    'email' => 'user@user.com',
                    'password' => 'user',
                    'phone' => '(11) 99876-5432',
                    'birth' => '1988-07-29',
                    'bio' => 'Administrador do sistema',
                    'active' => true
                ]
            )->save();
    }
}
