<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ProviderService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\StoreUpdateProvider;
use App\Http\Resources\ProviderResource;

class ProviderApiController extends ApiController
{
    protected $providerService;

    public function __construct(ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($flagTenant)
    {
        try {
            $provider =  $this->providerService->listProvider($flagTenant);
            return ProviderResource::collection($provider);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateProvider  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProvider $request, $flagTenant)
    {
        try {
            $provider =  $this->providerService->storeProvider($flagTenant, $request->all());
            return new ProviderResource($provider);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($flagTenant, $flagProvider)
    {
        try {
            $provider =  $this->providerService->showProvider($flagTenant, $flagProvider);
            return new ProviderResource($provider);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateProvider  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProvider $request, $flagTenant, $flagProvider)
    {
        try {
            $provider =  $this->providerService->updateProvider($flagTenant, $flagProvider, $request->all());
            return new ProviderResource($provider);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($flagTenant, $flagProvider)
    {
        try {
            $provider =  $this->providerService->deleteProvider($flagTenant, $flagProvider);
            return new ProviderResource($provider);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}