<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationChangeProfile extends FormRequest
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
            'fullname' => 'required|string|min:3|max:150',
            // 'username' => 'required|min:3|max:50',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    
    public function messages(): array
    {
        return [
            'fullname.required' => 'The fullname field is required.',
            'fullname.string' => 'The fullname must be a valid string.',
            'fullname.min' => 'The fullname must be at least 3 characters.',
            'fullname.max' => 'The fullname may not be greater than 150 characters.',

            // 'username.required' => 'The username field is required.',
            // 'username.min' => 'The username must be at least 3 characters.',
            // 'username.max' => 'The username may not be greater than 50 characters.',

        //    'image.image'       => 'The uploaded file must be an image.',
           'image.mimes'       => 'The image must be a file of type: jpeg, png, jpg, gif.',
           'image.max'         => 'The image may not be greater than 2MB.',


        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'fullname' => $this->fullname ? trim($this->fullname) : null,
            // 'username' => $this->username ? trim($this->username) : null
        ]);
    }
}