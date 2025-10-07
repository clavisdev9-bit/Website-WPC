<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormMessagesContactValidation extends FormRequest
{
    /**
     * Izinkan semua user mengirim form ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi form Contact.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:150',
            'phone' => ['required', 'regex:/^(\+?\d{7,15})$/'],
            'interested_in' => 'required|string|max:100',
            'subject' => 'required|string|max:800',
            'message' => 'required|string|min:5|max:2000',
            'agree_privacy' => 'accepted',
            // 'recaptcha_token' => 'nullable|string|max:500'
        ];
    }

    /**
     * Pesan error kustom (biar lebih ramah user).
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Your name is required.',
            'name.min' => 'Your name must be at least 3 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Your phone number is required.',
            'phone.regex' => 'Phone number format is invalid (use only digits, e.g. +62123456789).',
            'subject.required' => 'Subject is required.',
            'interested_in.required' => 'Please Select One Field',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Message must be at least 5 characters.',
            'message.max' => 'Message must be at least 800 characters.',
            'agree_privacy.accepted' => 'You must agree with the privacy policy.',
        ];
    }

    /**
     * Preprocessing (misalnya trimming input).
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => $this->name ? trim($this->name) : null,
            'email' => $this->email ? trim(strtolower($this->email)) : null,
            'subject' => $this->subject ? trim($this->subject) : null,
            'message' => $this->message ? trim($this->message) : null,
        ]);
    }
}
