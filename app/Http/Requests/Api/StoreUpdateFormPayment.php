<?php

namespace App\Http\Requests\Api;

use App\Tenant\Rules\UniqueTenant;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFormPayment extends FormRequest
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
        // $flag = $this->segment(4);
        $url = $this->segment(4) ?? null;
        // dd($flag, $url);
        return [
            "name" => [
                "required",
                "min:3",
                "max:255",
                new UniqueTenant('form_payments', $url,'url')
            ]
        ];
    }
}
