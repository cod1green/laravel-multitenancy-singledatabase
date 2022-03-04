<?php

namespace App\Repositories\Contracts;

interface ProviderRepository
{
    public function all();

    public function getProvidersByTenantId(int $idTenant);

    public function createProviderTenantId(int $idTenant, array $data);

    public function updateProviderUrlByTenantId(int $idTenant, string $flagProvider, array $data);

    public function getProviderUrlByTenantId(int $idTenant, string $flagProvider);

    public function deleteProviderUrlByTenantId(int $idTenant, string $flagProvider);
}
