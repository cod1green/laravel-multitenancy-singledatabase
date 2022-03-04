<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use UserACLTrait;
    use Billable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'plan_id',
        'tenant_id',
        'uuid',
        'name',
        'document',
        'username',
        'email',
        'phone',
        'password',
        'birth',
        'sex',
        'bio',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', 0);
    }

    public function isActive(): bool
    {
        return $this->active === 1;
    }

    public function getAccessEndAttribute()
    {
        $accessEndAt = $this->subscription('default')->ends_at;

        return Carbon::make($accessEndAt)->format("d/m/Y à\s H:i:s");
    }

    public function getCreatedAttribute()
    {
        return Carbon::make($this->created_at)->format("d/m/Y à\s H:i:s");
    }

    public function getUpdatedAttribute()
    {
        return Carbon::make($this->updated_at)->format("d/m/Y à\s H:i:s");
    }

    public function getBirthDateAttribute()
    {
        return Carbon::make($this->birth)->format("d/m/Y");
    }

    public function plan()
    {
        $stripePlan = $this->subscription('default')->stripe_price ?? null;
        return Plan::where('stripe_id', $stripePlan)->first();
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function userProfile($username)
    {
        return $this->with(['tenant', 'roles'])
            ->where('username', $username)
            ->orWhere('phone', $username)
            ->first();
    }

    public function userRoleAvailable($filter = null)
    {
        return Role::whereNotIn(
            'roles.id',
            function ($query) {
                $query->select('ur.role_id');
                $query->from('role_user AS ur');
                $query->whereRaw("ur.user_id={$this->id}");
            }
        )
            ->where(
                function ($query) use ($filter) {
                    $query->where('name', 'LIKE', "%{$filter}%");
                }
            );
    }

    public function search($filter = null)
    {
        $users = $this->join('tenants', 'tenants.id', '=', 'users.tenant_id')
            ->where(
                function ($query) use ($filter) {
                    if ($filter) {
                        $query->where('users.name', 'LIKE', "%{$filter}%");
                        $query->orWhere('tenants.name', 'LIKE', "%{$filter}%");
                    }
                }
            )
            ->select('users.*')
            ->latest()
            ->with('tenant')
            ->tenantUser();

        return $users;
    }

    public function scopeTenantUser(Builder $query)
    {
        // Retorna as usuarios da tenant atual
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }
}
