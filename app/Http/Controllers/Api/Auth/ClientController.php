<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Http\Requests\Api\StoreClient;
use App\Http\Resources\ClientResource;
use App\Http\Controllers\ApiController;

class ClientController extends ApiController
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function search(Request $request)
    {
        try {
            $client = $this->clientService->searchClient($request->filter);
            return  ClientResource::collection($client);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(StoreClient $request)
    {
        $data = $request->only('name', 'email', 'phone','document', 'sex');
        $data['address'] = $request->except('name', 'email', 'password', 'phone','document', 'sex');

        try {
            $client = $this->clientService->newClient($data);
            return new ClientResource($client);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
