<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTenant extends FormRequest
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

        if ($this->method() == 'PUT') {
            $rules = [
                'document' => ['required', "unique:tenants,document,{$id},id"],
                'company' => ['required', 'min:3', 'max:255', "unique:tenants,company,{$id},id"],
                'name' => ['required', 'min:3', 'max:255'],
                'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:14', 'max:15'],
                'email' => ['required', 'min:3', 'max:255', "unique:tenants,email,{$id},id"],
                'logo' => ['nullable', 'image'],
                'active' => ['required', 'in:Y,N'],
            ];
        } else {
            $rules = [
                'plan_id' => ['required', 'numeric'],
                'document' => ['required', "unique:tenants,document,{$id},id"],
                'company' => ['required', 'string', 'min:3', 'max:255', "unique:tenants,company,{$id},id"],
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:14', 'max:15'],
                'email' => ['required', 'string', 'email', 'min:3', 'max:255', "unique:tenants,email,{$id},id"],
                'logo' => ['nullable', 'image'],
                'active' => ['required', 'in:Y,N'],
            ];
        }

        return $rules;
    }
}
