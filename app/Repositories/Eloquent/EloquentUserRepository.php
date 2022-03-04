<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use App\Tenant\Scopes\TenantScope;

class EloquentUserRepository extends AbstractRepository implements UserRepository
{
    protected mixed $model = User::class;

    public function searchUser(int $idTenant, string $filter)
    {
        return $this->model->where('tenant_id', $idTenant)
            ->whereHas(
                'roles',
                function ($query) {
                    $query->where('name', 'Entregador');
                }
            )
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('document', 'LIKE', "%{$filter}%")
            ->withoutGlobalScope(TenantScope::class)
            ->paginate(10);
    }

    // public function createUser(array $data)
    // {
    //     //Inicia o Database Transaction
    //     DB::beginTransaction();

    //     if (empty($data['password']))
    //     {
    //         $data['password'] = Str::random(8);
    //     }
    //     $User = $this->entity->create($data);

    //     if($User->addAddress($data['address']))
    //     {
    //         //Sucesso!
    //         DB::commit();
    //         return $User;
    //     }

    //     //Fail, desfaz as alterações no banco de dados
    //     DB::rollBack();
    // }

    public function getUserUuidByTenantId(int $idTenant, string $uuidUser)
    {
        return $this->model->where('tenant_id', $idTenant)
            ->where('uuid', $uuidUser)
            ->withoutGlobalScope(TenantScope::class)
            ->first();
    }
}
