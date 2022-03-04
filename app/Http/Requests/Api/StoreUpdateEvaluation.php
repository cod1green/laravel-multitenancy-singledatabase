<?php

namespace App\Http\Requests\Api;

use App\Repositories\Contracts\OrderRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEvaluation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$user = auth()->user()) {
            return false;
        }

        if (!$order = app(OrderRepository::class)->getOrderByIdentify($this->identify)) {
            return false;
        }

        return $user->id == $order->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'min:3', 'max:1000']
        ];
    }
}
