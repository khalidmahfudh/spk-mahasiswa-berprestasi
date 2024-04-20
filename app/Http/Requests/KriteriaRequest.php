<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class KriteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            // Aturan validasi untuk create
            return [
                'nama_kriteria' =>  [
                    "required", 
                    "min:3", 
                    "max:100",
                    Rule::unique('kriteria', 'nama_kriteria')
                ],
                'kode_kriteria' =>  [
                    "required", 
                    "size:3",
                    Rule::unique('kriteria', 'kode_kriteria')
                ],
                'bilangan' => [
                    "required",
                    Rule::in(['bulat', 'pecahan']),
                ],
                'min_nilai' => [
                    "required",
                    "numeric"
                ],
                'max_nilai' => [
                    "required",
                    "numeric"
                ]
            ];

        } elseif ($this->isMethod('patch')) {
            // Aturan validasi untuk update
            return [
                'nama_kriteria' =>  [
                    'required',
                    'min:3',
                    'max:255',
                    Rule::unique('kriteria', 'nama_kriteria')->ignore($this->route('id')),
                ],
                'kode_kriteria' =>  [
                    "required", 
                    "size:3",
                    Rule::unique('kriteria', 'kode_kriteria')
                ],
                'bilangan' => [
                    "required",
                    Rule::in(['bulat', 'pecahan']),
                ],
                'min_nilai' => [
                    "required",
                    "numeric"
                ],
                'max_nilai' => [
                    "required",
                    "numeric"
                ]
            ];
        }
    
        return [];
    }

    public function messages(): array
    {
        return [
            'nama_kriteria.required' => 'Kolom Nama Kriteria wajib diisi.',
            'nama_kriteria.min' => 'Kolom Nama Kriteria harus memiliki minimal :min karakter.',
            'nama_kriteria.max' => 'Kolom Nama Kriteria tidak boleh melebihi :max karakter.',
            'nama_kriteria.unique' => 'Kolom Nama Kriteria sudah digunakan, harap pilih nama yang lain.',
            'kode_kriteria.required' => 'Kolom Kode Kriteria wajib diisi.',
            'kode_kriteria.size' => 'Kolom Kode Kriteria harus terdiri 3 karakter.',
            'kode_kriteria.unique' => 'Kolom Kode Kriteria sudah digunakan, harap pilih kode yang lain.',
            'bilangan.required' => 'Kolom Bilangan wajib dipilih.',
            'bilangan.in' => 'Kolom Bilangan harus berisi "bulat" atau "pecahan".',
            'min_nilai.required' => 'Kolom Nilai Minimum wajib diisi.',
            'min_nilai.numeric' => 'Kolom Nilai Minimum harus berisi angka.',
            'max_nilai.required' => 'Kolom Nilai Maksimum wajib diisi.',
            'max_nilai.numeric' => 'Kolom Nilai Maksimum harus berisi angka.',
        ];
    }
}
