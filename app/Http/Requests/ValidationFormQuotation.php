<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationFormQuotation extends FormRequest
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
            'name'                 => 'required|string|min:3|max:150',
            'phone'                => 'required|string|min:6|max:20',
            'email'                => 'required|email|max:150',
            'country'              => 'required',
            'state'                => 'required',
            'bussines_type'        => 'required',
            'transportation'       => 'required',
            'pickup_origin'        => 'required',
            'delivery_destination' => 'required',
            'cargo_details'        => 'required|string|min:5',
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.required'                 => 'The name field is required.',
            'name.min'                      => 'The name must be at least 3 characters.',
            'name.max'                      => 'The name may not be greater than 150 characters.',
            
            'phone.required'                => 'The phone number is required.',
            'phone.min'                     => 'The phone number must be at least 6 digits.',
            
            'email.required'                => 'The email address is required.',
            'email.email'                   => 'The email must be a valid email address.',
            
            'country.required'              => 'Please select a country.',
            'state.required'                => 'Please select a state/city.',
            'bussines_type.required'        => 'Please select a business type.',
            'transportation.required'       => 'Please select a transportation method.',
            'pickup_origin.required'        => 'Pickup origin is required.',
            'delivery_destination.required' => 'Delivery destination is required.',
            'cargo_details.required'        => 'Please provide cargo details.',
        ];
    }

    /**
     * Prepare data before validation (optional)
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name'          => $this->name ? trim($this->name) : null,
            'email'         => $this->email ? strtolower(trim($this->email)) : null,
            'phone'         => $this->phone ? trim($this->phone) : null,
            'cargo_details' => $this->cargo_details ? trim($this->cargo_details) : null,
        ]);
    }
}
