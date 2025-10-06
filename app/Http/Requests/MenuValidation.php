<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuValidation extends FormRequest
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
            'menu' => 'required|string|min:3|max:50'
        ];
    }
    
    public function messages(): array
    {
        return [
            'menu.required' => 'The menu field is required.',
            'menu.string' => 'The menu must be a valid string.',
            'menu.min' => 'The menu must be at least 3 characters.',
            'menu.max' => 'The menu may not be greater than 50 characters.'
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'menu' => $this->menu ? trim($this->menu) : null
        ]);
    }
}
