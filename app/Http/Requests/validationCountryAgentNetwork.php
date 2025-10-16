<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationCountryAgentNetwork extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

     public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name may not be greater than 50 characters.'
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => $this->name ? trim($this->name) : null
        ]);
    }
}
