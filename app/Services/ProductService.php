<?php
namespace App\Services;

use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\TenantRepository;

class ProductService
{
    protected TenantRepository $tenantRepository;
    protected ProductRepository $productRepository;

    public function __construct(
        TenantRepository $tenantRepository,
        ProductRepository $productRepository
    ) {
        $this->tenantRepository = $tenantRepository;
        $this->productRepository = $productRepository;
    }

    public function getProductsByTenantUuid($uuidTenant, $categories = null)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);
        return $this->productRepository->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProductsFilterByTenantUuid($uuidTenant, $filter = null)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);
        return $this->productRepository->getProductsFilterByTenantId($tenant->id, $filter);
    }

    public function getProductByFlag($uuidTenant, $uuidProduct)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);
        return $this->productRepository->getProductByUuid($tenant->id, $uuidProduct);
    }
}
