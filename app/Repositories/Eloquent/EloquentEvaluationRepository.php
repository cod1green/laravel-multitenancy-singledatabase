<?php

namespace App\Repositories\Eloquent;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepository;

class EloquentEvaluationRepository extends AbstractRepository implements EvaluationRepository
{
    protected mixed $model = Evaluation::class;

    public function newEvaluationOrder(int $idOrder, int $idUser, array $evaluation)
    {
        $data = [
            'user_id' => $idUser,
            'order_id' => $idOrder,
            'stars' => $evaluation['stars'],
            'comment' => isset($evaluation['comment']) ? $evaluation['comment'] : '',
        ];

        return $this->model->create($data);
    }

    public function getEvaluationsByOrder(int $idOrder)
    {
        return $this->model->where('order_id', $idOrder)->get();
    }

    public function getEvaluationsByUser(int $idUser)
    {
        return $this->model->where('user_id', $idUser)->get();
    }

    public function getEvaluationsById(int $id)
    {
        return $this->model->find($id);
    }

    public function getEvaluationsByUserIdByOrderId(int $idOrder, int $idUser)
    {
        return $this->model
            ->where('user_id', $idUser)
            ->where('order_id', $idOrder)
            ->first();
    }
}
