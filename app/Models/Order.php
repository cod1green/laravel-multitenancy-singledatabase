<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use TenantTrait;

    public const OPEN = 'open';
    public const REJECTED = 'rejected';

    public $statusOptions = [
        'open' => 'Aberto',
        'working' => 'Andamento',
        'delivering' => 'Em transito',
        'done' => 'Completo',
        'rejected' => 'Rejeitado',
        'canceled' => 'Cancelado',
    ];

    protected $fillable = [
        'tenant_id',
        'identify',
        'user_id',
        'table_id',
        'billing_email',
        'billing_name',
        'billing_address',
        'billing_city',
        'billing_province',
        'billing_postalcode',
        'billing_phone',
        'billing_name_on_card',
        'billing_discount',
        'billing_discount_code',
        'billing_subtotal',
        'billing_tax',
        'billing_total',
        'payment_gateway',
        'shipped',
        'status',
        'deliveryman',
        'error'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function deliverymen()
    {
        return $this->belongsTo(User::class, 'deliveryman', 'id', 'orders')
            ->withDefault(
                function ($user, $role) {
                    $role->name = "Entregador";
                }
            );
    }

    public function table()
    {
        return $this->belongsTo(Table::class)->withDefault();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['order_id', 'product_id', 'quantity', 'price']);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
