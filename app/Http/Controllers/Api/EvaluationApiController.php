<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Services\EvaluationService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Resources\EvaluationResource;
use App\Http\Requests\Api\StoreUpdateEvaluation;

class EvaluationApiController extends ApiController
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(StoreUpdateEvaluation $request, $identify)
    {
        try {
            $data = $request->only('comment', 'stars');

            $evaluation = $this->evaluationService->NewEvaluationOrder($identify, $data);
    
            return $this->successResponse(new EvaluationResource($evaluation), null, 201);
        } catch (\Throwable $e) {
            //throw $e;
            return $this->errorResponse($e->getMessage());
        }
    }
}
