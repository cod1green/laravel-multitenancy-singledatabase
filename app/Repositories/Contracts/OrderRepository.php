<?php
namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepository
{
    public function create($data): Order;

    public function registerProductsOrder(int $orderId, array $products);

    public function getOrdersByUserId(int $idUser);

    public function getOrdersByTenantId(int $idTenant, string $status, string $date = null);

    public function updateStatusOrder(string $uuid, string $status);
}
