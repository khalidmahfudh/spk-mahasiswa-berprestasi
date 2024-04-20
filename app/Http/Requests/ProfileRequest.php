<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
        if ($request->is('myprofile/updateprofile')) {
            $rules = [
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'username' => ['required', 'string', 'min:3', 'max:100', 'regex:/^\S*$/',  Rule::unique('users')->ignore($request->email, 'email')],
                'file' => 'mimes:jpg,jpeg,gif,png,bmp,svg,svgz,cgm,djv,djvu,ico,ief,jpe,pbm,pgm,pnm,ppm,ras,rgb,tif,tiff,wbmp,xbm,xpm,xwd',
            ];
        } else {  // update password
            $rules = [
                'current_password' => ['required', 'min:6'],
                'new_password' => ['required', 'min:8', 'confirmed'],
                'new_password_confirmation' => ['required', 'min:8']
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.min' => 'Nama harus minimal 3 karakter.',
            'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'username.required' => 'Kolom username harus diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.min' => 'Username harus minimal 3 karakter.',
            'username.max' => 'Username tidak boleh lebih dari 100 karakter.',
            'username.regex' => 'Username tidak boleh mengandung spasi.',
            'username.unique' => 'Username sudah digunakan.',
            'file.mimes' => 'Hanya menerima file berformat gambar.',
            'current_password.required' => 'Kolom password saat ini harus diisi.',
            'current_password.min' => 'Kolom password saat ini harus memiliki minimal :min karakter.',
            'new_password.required' => 'Kolom password baru harus diisi.',
            'new_password.min' => 'Kolom password baru harus memiliki minimal :min karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password_confirmation.required' => 'Kolom konfirmasi password baru harus diisi.',
            'new_password_confirmation.min' => 'Kolom konfirmasi password baru harus memiliki minimal :min karakter.'
        ];
    }
}
