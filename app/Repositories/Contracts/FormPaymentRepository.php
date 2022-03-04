<?php
namespace App\Repositories\Contracts;

interface FormPaymentRepository
{
    public function all();

    public function getFormPaymentsByTenantId(int $idTenant);

    public function createFormPaymentTenantId(int $idTenant, array $data);

    public function updateFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment, array $data);

    public function getFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment);

    public function deleteFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment);
}
