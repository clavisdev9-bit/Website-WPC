<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class submenuValidation extends FormRequest
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
            'menu' => 'required',
            'status' => 'required',
            'title' => 'required|string|min:3|max:50',
            'icon' => 'required|min:3|max:50',
            'url' => 'required|min:3|max:50',
            'noted' => 'max:250'
        ];
    }
    
    public function messages(): array
    {
        return [
            'menu.required' => 'Please select one of the menu.',
            'parent.required' => 'Please select one of the status.',
            'title.required' => 'The menu field is required.',
            'title.string' => 'The menu must be a valid string.',
            'title.min' => 'The menu must be at least 3 characters.',
            'title.max' => 'The menu may not be greater than 50 characters.',
            'icon.required' => 'The Icon field is required.',
            'icon.min' => 'The Icon must be at least 3 characters.',
            'icon.max' => 'The Icon may not be greater than 50 characters.',
            'url.required' => 'The url field is required.',
            'noted.max' => 'The noted may not be greater than 50 characters.'
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'title' => $this->title ? trim($this->title) : null,
            'icon' => $this->icon ? trim($this->icon) : null,
            'url' => $this->url ? trim($this->url) : null,
            'noted' => $this->noted ? trim($this->noted) : null
        ]);
    }
}