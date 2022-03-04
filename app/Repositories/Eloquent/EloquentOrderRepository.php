<?php
namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepository;

class EloquentOrderRepository extends AbstractRepository implements OrderRepository
{
    protected mixed $model = Order::class;

    public function create($data): Order
    {
        $order = $this->model->create($data);

        foreach ($data['products'] as $product) {
            $order->products()->attach(
                $product['product_id'],
                [
                    'quantity' => $product['quantity'],
                    'price' => $product['price']
                ]
            );
        }

        return $order;
    }

    public function registerProductsOrder(int $orderId, array $products)
    {
        $order = $this->model->find($orderId);

        foreach($products as $product) {
            $data[] = $order->products()->attach(
                $product['product_id'],
                [
                    'quantity' => $product['quantity'],
                    'price' => $product['price']
                ]
            );
        }

    }

    public function getOrdersByUserId(int $idUser)
    {
        return $this->model
            ->where('user_id', $idUser)
            ->paginate();
    }

    public function getOrdersByTenantId(int $idTenant, string $status, string $date = null)
    {
        return $this->model
            ->where('tenant_id', $idTenant)
            ->where(
                function ($query) use ($status) {
                    if ($status !== 'all') {
                        return $query->where('status', $status);
                    }
                }
            )
            ->where(
                function ($query) use ($date) {
                    if ($date) {
                        return $query->whereDate('created_at', $date);
                    }
                }
            )
            ->get();
    }

    public function updateStatusOrder(string $uuid, string $status)
    {
        $this->model->where('uuid', $uuid)->update(['status' => $status]);

        return $this->model->where('uuid', $uuid)->first();
    }
}
