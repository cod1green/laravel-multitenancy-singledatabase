<?php

namespace App\Http\Requests\Api;

use App\Repositories\TenantRepository;
use App\Services\OrderService;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth('web')->user();

        $uuidTenant = isset($user) ? $user->tenant->uuid : $this->segment(4);

        if(!app(TenantRepository::class)->getTenantByUuid($uuidTenant)) {
            return false; // 404
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'table' => [
                'nullable',
                // "required_unless:deliveryman,null",
                'exists:tables,uuid',
            ],
            'deliveryman' => [
                'nullable',
                // 'required_unless:table,null',
                'exists:users,uuid',
            ],
            'address' => [
                'required',
                'min:10',
                'max:5000',
            ],
            'comment' => [
                'nullable',
                'min:3',
                'max:1000',
            ],
            'shipping' => [
                'required',
                'numeric',
            ],
            'form_payment_id' => [
                'required',
                'exists:form_payments,id',
            ],
            'products' => ['required'],
            'products.*.identify' => ['required','exists:products,uuid'],
            'products.*.qty' => ['required','integer', 'regex:/^[1-9][0-9]*$/']
        ];
    }
}
