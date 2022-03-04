<?php
namespace App\Repositories\Eloquent;

use App\Models\Coupon;
use App\Repositories\Contracts\CouponRepository;

class EloquentCouponRepository extends AbstractRepository implements CouponRepository
{
    protected mixed $model = Coupon::class;

    public function getCouponsByTenantId($idTenant)
    {
        return $this->model->where('tenant_id', $idTenant)->paginate();
    }

    public function createCouponTenantId($idTenant, $data)
    {
        $data['tenant_id'] = $idTenant;
        return $this->model->create($data);
    }

    public function getCouponSlugByTenantId($idTenant, $slug)
    {
        return $this->model
            ->where('tenant_id', $idTenant)
            ->where('slug', $slug)
            ->first();
    }

    public function updateCouponByTenantId($idTenant, $slug, $data)
    {
        $coupon = $this->model
            ->where('tenant_id', $idTenant)
            ->where('slug', $slug)
            ->first();

        $coupon->update($data);

        return $coupon;
    }

    public function deleteCouponByTenantId($idTenant, $slug)
    {
        $coupon = $this->model
            ->where('tenant_id', $idTenant)
            ->where('slug', $slug)
            ->first();

        return $coupon->delete();
    }

    public function verifyCouponSlugByTenantId($idTenant, $slug)
    {
        return $this->model
            ->where('tenant_id', $idTenant)
            ->where('start_validity', '<', now())
            ->where('end_validity', '>', now())
            ->where('slug', '=', $slug)
            ->first();
    }
}
