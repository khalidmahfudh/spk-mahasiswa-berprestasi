<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "username_email" => ["required", "min:3", "max:100"],
            "password" => ["required", "min:6"]
        ];
    }

    public function attributes()
{
    return [
        'username_email' => 'Email atau Username'
    ];
}

    public function messages(): array
    {
        return [
            'username_email.required' => 'Kolom username_email harus diisi.',
            'username_email.min' => 'Username atau Email harus memiliki setidaknya :min karakter.',
            'username_email.max' => 'Username atau Email tidak boleh lebih dari :max karakter.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password harus memiliki setidaknya :min karakter.'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "username_email" => strtolower($this->input("username_email"))
        ]);
    }

}
