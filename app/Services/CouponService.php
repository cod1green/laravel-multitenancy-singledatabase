<?php
namespace App\Services;

use App\Repositories\Contracts\CouponRepository;
use App\Repositories\Contracts\TenantRepository;

class CouponService
{
    protected CouponRepository $couponRepository;
    protected TenantRepository $tenantRepository;

    public function __construct(
        CouponRepository $couponRepository,
        TenantRepository $tenantRepository
    ) {
        $this->couponRepository = $couponRepository;
        $this->tenantRepository = $tenantRepository;
    }


    public function listCoupons(string $flagTenant)
    {
        $tenant = $this->getTenant($flagTenant);

        return $this->couponRepository->getCouponsByTenantId($tenant->id);
    }

    public function getTenant($flagTenant)
    {
        if (!$tenant = $this->tenantRepository->getTenantByFlag($flagTenant)) {
            return false;
        }

        return $tenant;
    }

    public function storeCoupon(string $flagTenant, array $data)
    {
        $tenant = $this->getTenant($flagTenant);
        return $this->couponRepository->createCouponTenantId($tenant->id, $data);
    }

    public function showCoupon(string $flagTenant, string $flagCoupon)
    {
        $tenant = $this->getTenant($flagTenant);
        return $this->couponRepository->getCouponSlugByTenantId($tenant->id, $flagCoupon);
    }

    public function updateCoupon(array $data, string $flagTenant, string $flagCoupon)
    {
        $tenant = $this->getTenant($flagTenant);
        return $this->couponRepository->updateCouponByTenantId($tenant->id, $flagCoupon, $data);
    }

    public function deleteCoupon(string $flagTenant, string $flagCoupon)
    {
        $tenant = $this->getTenant($flagTenant);
        return $this->couponRepository->deleteCouponByTenantId($tenant->id, $flagCoupon);
    }

    public function verifyCoupon($flagTenant, $coupon)
    {
        $tenant = $this->getTenant($flagTenant);
        $coupon = $this->couponRepository->verifyCouponSlugByTenantId($tenant->id, $coupon);

        return $coupon ?? false;
    }

    public function verifyCouponOrder($idTenant, $coupon)
    {
        $coupon = $this->couponRepository->verifyCouponSlugByTenantId($idTenant, $coupon);

        switch ($coupon->limit_mode)
        {
            case 'quantity':

                break;

            case 'price':
        }
    }
}
