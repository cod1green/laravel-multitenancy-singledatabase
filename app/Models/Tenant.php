<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'document',
        'company',
        'name',
        'phone',
        'email',
        'url',
        'logo',
        'about',
        'active',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function formPayments()
    {
        return $this->hasMany(FormPayment::class);
    }

    public function getCreatedAttribute()
    {
        return Carbon::make($this->created_at)->format("d/m/Y à\s H:i:s");
    }

    public function getUpdatedAttribute()
    {
        return Carbon::make($this->updated_at)->format("d/m/Y à\s H:i:s");
    }
}
