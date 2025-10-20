<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubContinentRequest extends FormRequest
{
     public function authorize(): bool
    {
        // Set true biar bisa digunakan tanpa policy khusus
        return true;
    }

    public function rules(): array
    {
        return [
            'continent' => 'required',
            'name' => 'required|string|max:100|unique:subcontinents_network_agent,name',
            'code' => 'required|string|max:10|unique:subcontinents_network_agent,code',
        ];
    }

    public function messages(): array
    {
       return [
            'continent.required' => 'Please select one.',
            'name.required' => 'The continent name is required.',
            'name.unique' => 'The continent name already exists.',
            'name.max' => 'The continent name may not be greater than 100 characters.',
            'code.required' => 'The continent code is required.',
            'code.unique' => 'The continent code has already been taken.',
            'code.max' => 'The continent code may not be greater than 10 characters.',
        ];
    }
}
