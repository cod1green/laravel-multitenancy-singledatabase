<?php
namespace App\Repositories\Contracts;

interface TableRepository
{
    public function all();

    public function getTablesByTenantId(int $id);

    public function getTableIdentifyByTenantId(int $idTenant, string $identify);

    public function getTablesSearch(int $idTenant, string $filter);
}
