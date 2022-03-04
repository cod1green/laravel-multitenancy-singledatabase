<?php
namespace App\Services;

use App\Repositories\Contracts\EvaluationRepository;
use App\Repositories\Contracts\OrderRepository;

class EvaluationService
{
    protected EvaluationRepository $evaluationRepository;
    protected OrderRepository $orderRepository;

    public function __construct(
        EvaluationRepository $evaluationRepository,
        OrderRepository $orderRepository
    ) {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function newEvaluationOrder(string $identifyOrder, array $evaluation)
    {
        $userId = $this->getUserId();

        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->newEvaluationOrder($order->id, $userId, $evaluation);
    }


    private function getUserId()
    {
        return auth()->user()->id ?? 0;
    }
}
