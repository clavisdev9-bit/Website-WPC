<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => 'required|string|min:3|max:50',
            // 'idRole' => 'required'
        ];
    }
    
    public function messages(): array
    {
        return [
            'role.required' => 'The role field is required.',
            'role.string' => 'The role must be a valid string.',
            'role.min' => 'The role must be at least 3 characters.',
            'role.max' => 'The role may not be greater than 50 characters.',
            // 'idRole.required' => 'The id field is required.',
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'role' => $this->role ? trim($this->role) : null
        ]);
    }
    
}