<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\TenantRepository;
use Illuminate\Support\Facades\Hash;

class TenantService
{
    protected Plan $plan;
    protected array $data = [];
    private TenantRepository $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    public function getAllTenants()
    {
        return $this->tenantRepository->all();
    }

    public function getTenantByUuid(string $uuid)
    {
        return $this->tenantRepository->getTenantByUuid($uuid);
    }

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant(); // Return Tenants

        return $this->storeUser($tenant); // return User
    }

    public function storeTenant()
    {
        return $this->plan->tenants()->create(
            [
                'document' => $this->data['document'],
                'company' => $this->data['company'],
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'phone' => $this->data['phone'],
            ]
        );
    }

    public function storeUser($tenant)
    {
        return $tenant->users()->create(
            [
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'phone' => $this->data['phone'],
                'password' => Hash::make($this->data['password']),
            ]
        );
    }
}
