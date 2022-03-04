<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        "tenant_id",
        "uuid",
        "code",
        "type",
        "value",
        "quantity",
        "description",
        "start_validity",
        "end_validity",
        "active",
    ];

    public function discount($total)
    {
        if ($this->type === 'fixed') {
            return $this->value / 100;
        }

        if ($this->type === 'percent') {
            return round(($this->value / 100) * $total, 2);
        }

        return 0;
    }
}
