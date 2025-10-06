<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationContentAdd extends FormRequest
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
        'title'            => 'required|string|min:3|max:150',
        'meta_title'       => 'required|string|min:3|max:250',
        'meta_description' => 'required|string|min:3|max:250',
        'excerpt'          => 'required|string|min:3|max:250',
        'content'          => 'required|string|min:3|max:5000',
        'category_id'      => 'required|integer|exists:blog_categories,id',
        'is_published'     => 'required|boolean',
        'image'            => 'nullable|mimes:jpeg,png,jpg,gif|max:5048',
    ];
}

    
   public function messages(): array
{
    return [
        'title.required'            => 'The title field is required.',
        'title.string'              => 'The title must be a valid string.',
        'title.min'                 => 'The title must be at least 3 characters.',
        'title.max'                 => 'The title may not be greater than 150 characters.',

        'meta_title.required'       => 'The meta title field is required.',
        'meta_title.min'            => 'The meta title must be at least 3 characters.',
        'meta_title.max'            => 'The meta title may not be greater than 50 characters.',

        'meta_description.required' => 'The meta description field is required.',
        'meta_description.min'      => 'The meta description must be at least 3 characters.',
        'meta_description.max'      => 'The meta description may not be greater than 150 characters.',

        'excerpt.required'          => 'The excerpt field is required.',
        'excerpt.min'               => 'The excerpt must be at least 3 characters.',
        'excerpt.max'               => 'The excerpt may not be greater than 50 characters.',

        'content.required'          => 'The content field is required.',
        'content.min'               => 'The content must be at least 3 characters.',
        'content.max'               => 'The content may not be greater than 500 characters.',

        'category_id.required'      => 'Select one category.',
        'category_id.integer'       => 'Invalid category.',
        'category_id.exists'        => 'Selected category does not exist.',

        'is_published.required'     => 'Select publish status.',
        'is_published.boolean'      => 'Invalid publish status.',

        'image.mimes'               => 'The image must be a file of type: jpeg, png, jpg, gif.',
        'image.max'                 => 'The image may not be greater than 5MB.',
    ];
}

    
    protected function prepareForValidation()
{
    $this->merge([
        'title'            => $this->title ? trim($this->title) : null,
        'meta_title'       => $this->meta_title ? trim($this->meta_title) : null,
        'meta_description' => $this->meta_description ? trim($this->meta_description) : null,
        'excerpt'          => $this->excerpt ? trim($this->excerpt) : null,
    ]);
}

}
