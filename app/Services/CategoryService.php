<?php
namespace App\Services;

use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\TenantRepository;

class CategoryService
{
    protected CategoryRepository $categoryRepository;
    protected TenantRepository $tenantRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        TenantRepository $tenantRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }

    public function getCategoryByTenantUuid($uuidTenant, $flag)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);

        return $this->categoryRepository->getCategoryFlagByTenantId($tenant->id, $flag);
    }

}
