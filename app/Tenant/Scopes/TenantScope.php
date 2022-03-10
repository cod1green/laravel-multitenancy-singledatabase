<?php

namespace App\Tenant\Scopes;

use App\Tenant\Services\TenantManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $manager = app(TenantManager::class);
        $builder->where('tenant_id', '=', $manager->getTenant()->id);
    }

    public function extend(Builder $builder) {
        $this->addWithoutTenancy($builder);
    }

    protected function addWithoutTenancy(Builder $builder) {
        $builder->macro('withoutTenancy', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }
}
