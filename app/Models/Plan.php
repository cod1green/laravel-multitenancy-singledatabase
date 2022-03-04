<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = "plans";

    protected $fillable = [
        'name',
        'url',
        'price',
        'description',
        'recommended',
        'period',
        'access',
        'stripe_id'
    ];

    /*
    protected static function booted(): void
    {
        static::addGlobalScope(
            'access',
            static function (Builder $builder) {
                $builder->where('access', 'public');
            }
        );
    }
    */

    public function scopePublic($query)
    {
        return $query->where('access', 'public');
    }

    public function scopePrivate($query)
    {
        return $query->where('access', 'private');
    }

    public function scopeVip($query)
    {
        return $query->where('url', 'vip');
    }

    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'plan_group');
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }

    public function groupsAvailable($filter = null)
    {
        $groups = Group::whereNotIn(
            'id',
            function ($query) {
                $query->select('plan_group.group_id');
                $query->from('plan_group');
                $query->whereRaw("plan_group.plan_id={$this->id}");
            }
        )
            ->where(
                function ($queryFilter) use ($filter) {
                    if ($filter) {
                        $queryFilter->where('groups.name', 'LIKE', "%{$filter}%");
                    }
                }
            );

        return $groups;
    }

    public function getPriceBrAttribute()
    {
        return number_format($this->price, 2, ',', '.');
    }
}
