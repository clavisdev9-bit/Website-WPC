<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNetworkAgentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a network agent.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'country' => 'required|exists:countries_network_agent,id',
            'city' => 'required|exists:cities_network_agent,id',
            'address' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ];
    }

    /**
     * Custom error messages (optional but recommended).
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Agent name is required.',
            'country.required' => 'Please select a country.',
            'city.required' => 'Please select a city.',
            'address.required' => 'Address is required.',
            'lat.required' => 'Latitude is required.',
            'lng.required' => 'Longitude is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'phone.required' => 'Phone number is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Allowed image formats: jpeg, jpg, png, gif, webp.',
        ];
    }
}
