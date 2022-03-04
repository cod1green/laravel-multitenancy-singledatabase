<?php

namespace App\Http\Controllers\Api;

use App\Services\TenantService;
use App\Http\Resources\TenantResource;
use App\Http\Controllers\ApiController;

class TenantApiController extends ApiController
{

    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index()
    {
        try {
            $tenants = $this->tenantService->getAllTenants();
            return $this->successResponse(TenantResource::collection($tenants));
        } catch (\Throwable $e) {
            //throw $e;
            return $this->errorResponse($e->getMessage());
        }

    }

    public function show($uuid)
    {
        try {
            $tenant = $this->tenantService->getTenantByUuid($uuid);
            return $this->successResponse(new TenantResource($tenant));
        } catch (\Throwable $e) {
            //throw $e;
            return $this->errorResponse($e->getMessage());
        }

    }
}
