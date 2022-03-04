<?php

namespace App\Observers;

use App\Events\OrderCreated;
use App\Models\Order;
use Illuminate\Support\Str;

class OrderObserver
{
    public function creating(Order $order): void
    {
        $order->uuid = Str::uuid();
        $order->status = ($order->error === null) ? Order::OPEN : Order::REJECTED;
    }

    public function updating(Order $order): void
    {
        //
    }

    public function created(Order $order): void
    {
        broadcast(new OrderCreated($order)); //Enviar notificação push
    }
}
