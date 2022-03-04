<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = [
        'tenant_id',
        'provider_id',
        'name',
        'slug',
        'image',
        'quantity',
        'min_quantity',
        'lucre',
        'cost_price',
        'price',
        'description',
        'featured'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(['order_id', 'product_id', 'quantity', 'price']);
    }

    public function categoriesAvailable($filter = null)
    {
        $categories = Category::whereNotIn(
            'categories.id',
            function ($query) {
                $query->select('category_product.category_id');
                $query->from('category_product');
                $query->whereRaw("category_product.product_id={$this->id}");
            }
        )
            ->where(
                function ($queryFilter) use ($filter) {
                    if ($filter) {
                        $queryFilter->where('name', 'LIKE', "%{$filter}%");
                        $queryFilter->orWhere('description', 'LIKE', "%{$filter}%");
                    }
                }
            );

        return $categories;
    }

    public function imageUrl()
    {
        return empty($this->image) ? url("images/company_none.png") : url("storage/{$this->image}");
    }

    public function presentPrice()
    {
        return 'R$' . number_format($this->price, 2, ',', '.');
    }

    public function getCreatedAttribute()
    {
        return Carbon::make($this->created_at)->format("d/m/Y à\s H:i:s");
    }

    public function getUpdatedAttribute()
    {
        return Carbon::make($this->updated_at)->format("d/m/Y à\s H:i:s");
    }

    public function search($filter = null)
    {
        return $this->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('details', 'like', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->orWhere('uuid', 'LIKE', "%{$filter}%");
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }
}
