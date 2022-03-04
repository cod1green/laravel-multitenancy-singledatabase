<?php
namespace App\Services;

use App\Repositories\Contracts\FormPaymentRepository;
use App\Repositories\Contracts\TenantRepository;

class FormPaymentService
{
    protected FormPaymentRepository $formPaymentRepository;
    protected TenantRepository $tenantRepository;

    public function __construct(
        FormPaymentRepository $formPaymentRepository,
        TenantRepository $tenantRepository
    ) {
        $this->formPaymentRepository = $formPaymentRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function listFormPayment()
    {
        $idTenant = $this->tenantId();
        return $this->formPaymentRepository->getFormPaymentsByTenantId($idTenant);
    }

    public function tenantId()
    {
        return auth('web')->user()->tenant->id;
    }

    public function storeFormPayment(array $data)
    {
        $idTenant = $this->tenantId();
        // $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->createFormPaymentTenantId($idTenant, $data);
    }

    public function showFormPayment(string $flagFormPayment)
    {
        $idTenant = $this->tenantId();

        // if( !$tenant = $this->tenantRepository->getTenantByFlag($flagTenant) )
        //     return false;

        return $this->formPaymentRepository->getFormPaymentUrlByTenantId($idTenant, $flagFormPayment);
    }

    public function updateFormPayment(string $flagFormPayment, array $data)
    {
        $idTenant = $this->tenantId();

        // $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->updateFormPaymentUrlByTenantId($idTenant, $flagFormPayment, $data);
    }

    public function deleteFormPayment(string $flagFormPayment)
    {
        $idTenant = $this->tenantId();

        // $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->deleteFormPaymentUrlByTenantId($idTenant, $flagFormPayment);

    }
}
