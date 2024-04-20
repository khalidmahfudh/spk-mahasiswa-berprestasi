<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class UsersRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'role' => ['required', 'in:user,admin'],
            'is_active' => ['required', 'numeric', 'in:0,1']
        ];

        if ($this->isMethod('post')) {
            $rules += [
                'username' => ['required', 'string', 'min:3', 'max:100', 'regex:/^\S*$/',  Rule::unique('users')],
                'email' => ['required', 'email', 'max:100', Rule::unique('users')],
                'password' => ['required', 'min:6'],
                'password_confirmation' => ['required', 'same:password'],
            ];
        } else {
            $rules += [
                'username' => ['required', 'string', 'min:3', 'max:100', 'regex:/^\S*$/',  Rule::unique('users')->ignore($request->id)],
                'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore($request->id)],
                'password' => ['nullable','min:6'],
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'name.string' => 'Kolom nama harus berupa teks.',
            'name.min' => 'Kolom nama harus memiliki panjang minimal :min karakter.',
            'name.max' => 'Kolom nama harus memiliki panjang maksimal :max karakter.',
            'username.required' => 'Kolom username harus diisi.',
            'username.string' => 'Kolom username harus berupa teks.',
            'username.min' => 'Kolom username harus memiliki panjang minimal :min karakter.',
            'username.max' => 'Kolom username harus memiliki panjang maksimal :max karakter.',
            'username.regex' => 'Kolom username hanya dapat berisi karakter non-spasi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Kolom email harus memiliki panjang maksimal :max karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'role.required' => 'Kolom role harus diisi.',
            'role.in' => 'Kolom role harus memiliki salah satu dari nilai berikut: user, admin.',
            'is_active.required' => 'Kolom is_active harus diisi.',
            'is_active.numeric' => 'Kolom is_active harus berupa angka.',
            'is_active.in' => 'Kolom is_active harus memiliki salah satu dari nilai berikut: 0, 1.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Kolom password harus memiliki panjang minimal :min karakter.',
            'password_confirmation.required' => 'Kolom konfirmasi password harus diisi.',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok dengan password.'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "name" => strtolower($this->input("name")),
            "username" => strtolower($this->input("username")),
        ]);
    }

    protected function passedValidation(): void
    {
        $this->merge([
            "password" => bcrypt($this->input("password")),
            "password_confirmation" => ''
        ]);
    }

}
