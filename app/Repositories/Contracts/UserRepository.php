<?php
namespace App\Repositories\Contracts;

interface UserRepository
{
    public function all();

    public function searchUser(int $idTenant, string $filter);

    public function getUserUuidByTenantId(int $idTenant, string $uuidUser);
}
