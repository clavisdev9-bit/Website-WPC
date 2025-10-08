<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryBlogValidation extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3|max:255',
        ];
    }

    /**
     * Pesan custom untuk validasi.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string'   => 'The name must be a valid string.',
            'name.min'      => 'The name must be at least 3 characters.',
            'name.max'      => 'The name may not be greater than 50 characters.',

            'description.required' => 'The description field is required.',
            'description.string'   => 'The description must be a valid string.',
            'description.min'      => 'The description must be at least 3 characters.',
            'description.max'      => 'The description may not be greater than 255 characters.',
        ];
    }

    /**
     * Persiapkan data sebelum validasi (misalnya trimming).
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->name ? trim($this->name) : null,
            'description' => $this->description ? trim($this->description) : null,
        ]);
    }
}
