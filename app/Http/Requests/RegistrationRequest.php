<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'username' => ['required', 'string', 'regex:/^[a-zA-Z0-9_-]+$/', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.min' => 'Nama minimal harus memiliki :min karakter.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal harus memiliki :min karakter.',
            'username.max' => 'Username tidak boleh lebih dari :max karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari :max karakter.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus memiliki :min karakter.',
            'password_confirmation.required' => 'Konfirmasi password harus diisi.',
            'password_confirmation.same' => 'Konfirmasi password harus sama dengan password.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "name" => strtolower($this->input("name"))
        ]);
    }

    protected function passedValidation(): void
    {
        $this->merge([
            "password" => bcrypt($this->input("password"))
        ]);
    }
}
