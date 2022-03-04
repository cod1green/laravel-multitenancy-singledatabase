<?php
namespace App\Services\Order;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepository;

class OrderCreator
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $order): Order
    {
        return $this->orderRepository->create($order);
    }
}
