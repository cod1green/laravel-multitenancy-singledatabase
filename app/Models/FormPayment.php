<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPayment extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['name', 'description', 'tenant_id'];
}
