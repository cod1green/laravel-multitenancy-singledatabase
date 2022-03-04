<?php

namespace App\Http\Requests;

use App\Tenant\Rules\UniqueTenant;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategory extends FormRequest
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
        $id = $this->segment(3);
        return [
            'name' => [
                "required",
                "string",
                "min:3",
                "max:100",
                new UniqueTenant('categories', $id)
            ],
            'icon' => "nullable|string",
            'description' => "nullable|min:3|max:500"
        ];
    }
}
