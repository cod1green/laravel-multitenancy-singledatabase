<?php
namespace App\Services;

use App\Repositories\Contracts\TableRepository;
use App\Repositories\Contracts\TenantRepository;

class TableService
{
    protected TableRepository $tableRepository;
    protected TenantRepository $tenantRepository;

    public function __construct(
        TableRepository $tableRepository,
        TenantRepository $tenantRepository
    ) {
        $this->tableRepository = $tableRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getTablesByTenantUuid($uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->tableRepository->getTablesByTenantId($tenant->id);
    }

    public function getTableByTenantUuid($uuidTenant, $identify)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);

        $table = $this->tableRepository->getTableIdentifyByTenantId($tenant->id, $identify);
        return $table;
    }

    public function getTablesSearch($request)
    {
        $idTenant = $request->user()->tenant->id;

        return $this->tableRepository->getTablesSearch($idTenant, $request->filter);
    }
}
