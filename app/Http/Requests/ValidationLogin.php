<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationLogin extends FormRequest
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
        'email' => 'required|string|email|max:50',
        'password' => 'required|string|min:5',
    ];
}

public function messages(): array
{
    return [
        'email.required' => 'The email field is required.',
        'email.string' => 'The email must be a valid string.',
        'email.email' => 'The email must be a valid email address.',
        'email.max' => 'The email may not be greater than 50 characters.',
        'password.required' => 'The password field is required.',
        'password.string' => 'The password must be a valid string.',
        'password.min' => 'The password must be at least 5 characters.',
    ];
}

protected function prepareForValidation()
{
    $this->merge([
        'email' => $this->email ? trim($this->email) : null,
        'password' => $this->password ? trim($this->password) : null,
    ]);
}
}