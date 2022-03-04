<?php
namespace App\Repositories\Contracts;

interface CategoryRepository
{
    public function all();

    public function getCategoriesByTenantUuid(string $uuid);

    public function getCategoriesByTenantId(int $idTenant);

    public function getCategoryFlagByTenantId(int $idTenant, string $flag);
}
