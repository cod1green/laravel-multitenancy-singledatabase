<?php

namespace App\Repositories\Contracts;

interface EvaluationRepository
{
    public function all();

    public function newEvaluationOrder(int $idOrder, int $idUser, array $evaluation);

    public function getEvaluationsByOrder(int $idOrder);

    public function getEvaluationsByUser(int $idUser);

    public function getEvaluationsById(int $id);

    public function getEvaluationsByUserIdByOrderId(int $idOrder, int $idUser);
}
