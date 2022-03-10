<?php

namespace App\Tenant\Observers;

use App\Tenant\Services\TenantManager;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    public function creating(Model $model)
    {
        if (! $model->tenant_id && ! $model->relationLoaded('tenant')) {
            $model->setRelation('tenant', app(TenantManager::class)->getTenant());
        }

        return $model;
    }
}
