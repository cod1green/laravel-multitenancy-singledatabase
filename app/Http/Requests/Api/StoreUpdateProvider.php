<?php

namespace App\Http\Requests\Api;

use App\Tenant\Rules\UniqueTenant;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProvider extends FormRequest
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
        $url = $this->segment(6) ?? null;
        // dd($flag, $url);
        return [
            "name" => [
                "required",
                "min:3",
                "max:255",
                new UniqueTenant('providers', $url,'url', $flag, 'url')
            ],
            "about" => ["nullable", "min:3", "max:255"],
            "address" => ["nullable", "min:3", "max:255"],
            "email" => ["nullable", "min:3", "max:255"],
            "document" => ["nullable", "min:3", "max:255"],
        ];
    }
}
