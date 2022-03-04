<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\TableService;
use App\Http\Resources\TableResource;
use App\Http\Controllers\ApiController;

class TableApiController extends ApiController
{
    protected $tableService;
    
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function tablesByTenant($uuid)
    {
        try {
            $table = $this->tableService->getTablesByTenantUuid($uuid);
            return TableResource::collection($table);
        } catch (\Throwable $e) {
            //throw $th;
            return $this->errorResponse($e->getMessage());
        }
    }

    public function tableByTenant($uuidTenant, $identify)
    {
        try {
            $table = $this->tableService->getTableByTenantUuid($uuidTenant, $identify);
            return $this->successResponse( new TableResource($table));
        } catch (\Throwable $e) {
            //throw $e;
            return $this->errorResponse($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $table = $this->tableService->getTablesSearch($request);
            return TableResource::collection($table);
        } catch (\Throwable $e) {
            //throw $th;
            return $this->errorResponse($e->getMessage());
        }
    }
}
