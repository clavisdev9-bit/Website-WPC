<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgentCityNetworkRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pastikan user boleh melakukan aksi ini
        return true;
    }

    public function rules(): array
    {
        return [
            'country' => ['required', 'exists:countries_network_agent,id'],
            'name' => ['required', 'string', 'max:100'],
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
        ];
    }

    public function messages(): array
    {
        return [
            'country.required' => 'Country is required.',
            'country.exists' => 'The selected country is invalid.',
            'name.required' => 'City name is required.',
            'name.max' => 'City name must not exceed 100 characters.',
            'lat.required' => 'Latitude is required.',
            'lat.numeric' => 'Latitude must be a number.',
            'lat.between' => 'Latitude must be between -90 and 90.',
            'lng.required' => 'Longitude is required.',
            'lng.numeric' => 'Longitude must be a number.',
            'lng.between' => 'Longitude must be between -180 and 180.',
        ];

    }
}
