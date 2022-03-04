<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
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
        return [
            'name' => 'required|min:3|max:60',
            'phone' => 'required|string|min:11|max:15|unique:clients',
            'email' => 'nullable|email|min:3|max:60|unique:clients',
            'document' => 'nullable|string|min:11|max:14|unique:clients,document',
            'password' => 'nullable|min:3|max:60',
            'street'       => 'required|string|min:3|max:60',
            'street_extra' => 'required|string|min:3|max:60',
            'city'         => 'required|string|min:3|max:60',
            'state'        => 'required|string|min:3|max:60',
            'post_code'    => 'required|min:4|max:10|AlphaDash',
            'country_id'   => 'required|integer',
            'country'       => 'required|string',
        ];
    }
}
