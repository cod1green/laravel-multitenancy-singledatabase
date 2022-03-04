<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FormPaymentService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\FormPaymentResource;
use App\Http\Requests\Api\StoreUpdateFormPayment;

class FormPaymentApiController extends ApiController
{
    protected $formPaymentService;

    public function __construct(FormPaymentService $formPaymentService)
    {
        $this->formPaymentService = $formPaymentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $formPayment =  $this->formPaymentService->listFormPayment();
            return FormPaymentResource::collection($formPayment);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateFormPayment  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateFormPayment $request, $flagTenant = null)
    {
        $flagTenant = empty($flagTenant) ? auth('web')->user()->tenant->url : $flagTenant;

        try {
            $formPayment =  $this->formPaymentService->storeFormPayment($request->all());
            return new FormPaymentResource($formPayment);
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
    public function show($flagFormPayment)
    {
        try {
            $formPayment =  $this->formPaymentService->showFormPayment($flagFormPayment);
            return $this->successResponse(new FormPaymentResource($formPayment));
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateFormPayment  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFormPayment $request, $flagFormPayment)
    {
        try {
            $formPayment =  $this->formPaymentService->updateFormPayment($flagFormPayment, $request->all());
            return new FormPaymentResource($formPayment);
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
    public function destroy($flagFormPayment)
    {
        try {
            $formPayment =  $this->formPaymentService->deleteFormPayment($flagFormPayment);
            return new FormPaymentResource($formPayment);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
