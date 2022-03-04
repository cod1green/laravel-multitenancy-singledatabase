<?php

namespace App\Tenant\Rules;

use App\Tenant\ManagerTenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueTenant implements Rule
{
    protected $table, $value, $column, $valueTenant, $columnTenant;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        string $table, 
        $value = null, 
        $column = 'id',
        $valueTenant = null, 
        $columnTenant = 'id'
    )
    {
        $this->table = $table;
        $this->column = $column;
        $this->value = $value;
        $this->columnTenant = $columnTenant;
        $this->valueTenant = $valueTenant;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$tenantId = app(ManagerTenant::class)->getTenantIdentify()) 
        {
            $tenantId = DB::table('tenants')
                                ->where("{$this->columnTenant}", $this->valueTenant)
                                ->first()
                                ->id;
        }

        $register = DB::table($this->table)
                            ->where('tenant_id', $tenantId)
                            ->where($attribute, $value)
                            ->first();

        if($register && $register->{$this->column} == $this->value)
            return true;

        return is_null($register);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.unique');
    }
}
