<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = [
        "tenant_id",
        "uuid",
        "name",
        "url",
        "document",
        "email",
        "phone",
        "about",
        "address",
    ];
}
