<?php

namespace App\Repositories\Eloquent;

use App\Models\Provider;
use App\Repositories\Contracts\ProviderRepository;

class EloquentProviderRepository extends AbstractRepository implements ProviderRepository
{
    protected mixed $model = Provider::class;

    public function getProvidersByTenantId(int $idTenant)
    {
        return $this->model
            ->where('tenant_id', $idTenant)
            ->paginate();
    }

    public function createProviderTenantId(int $idTenant, array $data)
    {
        $data['tenant_id'] = $idTenant;
        return $this->model->create($data);
    }

    public function updateProviderUrlByTenantId(int $idTenant, string $flagProvider, array $data)
    {
        $provider = $this->model
            ->where('url', $flagProvider)
            ->where('tenant_id', $idTenant)
            ->first();

        $provider->update($data);

        return $provider;
    }

    public function getProviderUrlByTenantId(int $idTenant, string $flagProvider)
    {
        return $this->model
            ->where('url', $flagProvider)
            ->where('tenant_id', $idTenant)
            ->first();
    }

    public function deleteProviderUrlByTenantId(int $idTenant, string $flagProvider)
    {
        $provider = $this->model
            ->where('url', $flagProvider)
            ->where('tenant_id', $idTenant)
            ->first();

        $provider->delete();

        return $provider;
    }
}
