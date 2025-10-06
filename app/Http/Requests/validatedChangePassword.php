<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validatedChangePassword extends FormRequest
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
            'password' => 'required|min:5',
            'passconf' => 'required|same:password',
        ];
    }
    
    public function messages(): array
    {
        return [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 5 characters.',

           'passconf.required' => 'The password confirmation field is required.',
           'passconf.same' => 'The password confirmation does not match.',
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'password' => $this->password ? trim($this->password) : null,
            'passconf' => $this->passconf ? trim($this->passconf) : null
        ]);
    }
}