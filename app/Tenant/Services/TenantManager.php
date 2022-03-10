<?php

namespace App\Tenant\Services;

use App\Models\Tenant;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TenantManager
{
    private ?Tenant $tenant;

    public function setTenant(?Tenant $tenant)
    {
        $this->tenant = $tenant;
        return $this;
    }

    public function getTenant(): ?Tenant
    {
        return $this->tenant;
    }

    public function loadTenant(string $identifier, bool $subdomain): bool {
        $tenant = Tenant::query()->where($subdomain ? 'subdomain' : 'domain', '=', $identifier)->first();

        if ($tenant) {
            $this->setTenant($tenant);
            return true;
        }

        return false;
    }

    /**
     * Como usar TenantManager::unique() nas validações
     */
    public static function unique($table, $column = 'NULL')
    {
        return (new Unique($table, $column))->where('tenant_id', $this->getTenant()->id);
    }

    public static function exists($table, $column = 'NULL')
    {
        return (new Exists($table, $column))->where('tenant_id', $this->getTenant()->id);
    }
}
