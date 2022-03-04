<?php

namespace App\Repositories\Contracts;

interface TenantRepository
{
    public function all();

    public function getTenantByUuid(string $uuid);

    public function getTenantByFlag(string $flag);
}
