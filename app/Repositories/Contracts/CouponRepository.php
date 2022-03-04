<?php
namespace App\Repositories\Contracts;

interface CouponRepository
{
    public function all();

    public function getCouponsByTenantId(int $idTenant);

    public function createCouponTenantId(int $idTenant, array $data);

    public function updateCouponByTenantId(int $idTenant, string $slug, array $data);

    public function getCouponSlugByTenantId(int $idTenant, string $slug);

    public function deleteCouponByTenantId(int $idTenant, string $slug);

    public function verifyCouponSlugByTenantId(int $idTenant, string $slug);
}
