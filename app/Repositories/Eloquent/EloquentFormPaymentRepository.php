<?php

namespace App\Repositories\Eloquent;

use App\Models\FormPayment;
use App\Repositories\Contracts\FormPaymentRepository;

class EloquentFormPaymentRepository extends AbstractRepository implements FormPaymentRepository
{
    protected mixed $model = FormPayment::class;

    public function getFormPaymentsByTenantId(int $idTenant)
    {
        $formPayments = $this->model
            ->where('tenant_id', $idTenant)
            ->paginate();

        return $formPayments;
    }

    public function createFormPaymentTenantId(int $idTenant, array $data)
    {
        $data['tenant_id'] = $idTenant;
        return $this->model->withoutGlobalScope(TenantScope::class)->create($data);
    }

    public function updateFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment, array $data)
    {
        $formPayment = $this->model
            ->where('url', $flagFormPayment)
            ->where('tenant_id', $idTenant)
            ->withoutGlobalScope(TenantScope::class)
            ->first();

        $formPayment->update($data);

        return $formPayment;
    }

    public function getFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment)
    {
        $formPayment = $this->model
            ->where('tenant_id', $idTenant)
            ->where('url', $flagFormPayment)
            ->first();

        return $formPayment;
    }

    public function deleteFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment)
    {
        $formPayment = $this->model
            ->where('url', $flagFormPayment)
            ->where('tenant_id', $idTenant)
            ->first();

        $formPayment->delete();

        return $formPayment;
    }
}
