<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationUser extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->filled('id_user'); 
        return [
            'fullname' => 'required|string|min:3|max:150',
            'username' => 'required|min:3|max:50',
            'email'    => 'required|email|max:100',
            'password' => $isUpdate ? 'nullable|min:5' : 'required|min:5',
            'passconf' => $isUpdate ? 'same:password' : 'required|same:password',
            'role'     => 'required',
            'group'    => 'required',
            'divisi'   => 'required',
            'status'   => 'required',
            'image'    => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    
    public function messages(): array
    {
        return [
            'fullname.required' => 'The fullname field is required.',
            'fullname.string'   => 'The fullname must be a valid string.',
            'fullname.min'      => 'The fullname must be at least 3 characters.',
            'fullname.max'      => 'The fullname may not be greater than 150 characters.',

            'username.required' => 'The username field is required.',
            'username.min'      => 'The username must be at least 3 characters.',
            'username.max'      => 'The username may not be greater than 50 characters.',

            'email.required' => 'The email field is required.',
            'email.email'    => 'The email must be a valid email address.',
            'email.max'      => 'The email may not be greater than 100 characters.',
            'email.unique'   => 'This email is already registered.',

            'password.required' => 'The password field is required.',
            'password.min'      => 'The password must be at least 5 characters.',

            'passconf.required' => 'The password confirmation field is required.',
            'passconf.same'     => 'The password confirmation does not match.',

            'role.required'   => 'Select one role.',
            'group.required'  => 'Select one Group.',
            'divisi.required' => 'Select one division.',
            'status.required' => 'Select one status.',

            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max'   => 'The image may not be greater than 2MB.',
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'fullname' => $this->fullname ? trim($this->fullname) : null,
            'username' => $this->username ? trim($this->username) : null,
            'email'    => $this->email ? strtolower(trim($this->email)) : null,
        ]);
    }
}
