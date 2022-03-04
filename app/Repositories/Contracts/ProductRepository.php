<?php

namespace App\Repositories\Contracts;

interface ProductRepository
{
    public function all();

    public function getProductsByTenantId(int $idTenant, array $categories = null);

    public function getProductsFilterByTenantId(int $idTenant, string $filter = '');

    public function getProductByUuid(int $idTenant, string $uuid);
}
