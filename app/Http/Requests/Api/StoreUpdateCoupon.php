<?php

namespace App\Http\Requests\Api;

use App\Models\Tenant;
use Illuminate\Validation\Rule;
use App\Tenant\Rules\UniqueTenant;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCoupon extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $flag = $this->segment(4);
        $url = $this->segment(6);
        //$tenant = Tenant::where('url', $flag)->first();

        return [
            "name" => [
                // Rule::unique('coupons')->where(function ($query) use ($tenant) {
                //     $query->where('tenant_id', $tenant->id)
                //                     ->where('tenant_id', $tenant->id);
                // })
                new UniqueTenant('coupons', $url,'url', $flag, 'url')
            ],
            "description" => ["nullable", "min:3", "max:255"],
            "discount" => ["required"],
            "discount_mode" => [
                "required",
                Rule::in(['price', 'percentage'])
            ],
            "limit" => ["required"],
            "limit_mode" => [
                "required",
                Rule::in(['price', 'quantity'])
            ],
            "start_validity" => ["required"],
            "end_validity" => ["required"],
            "active" => [
                "nullable",
                Rule::in(['yes', 'no'])
            ],
        ];
    }
}
