<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class MahasiswaRequest extends FormRequest
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
            // Aturan validasi untuk atribut nama_mahasiswa dan nim.
            'nama_mahasiswa' => ['required', 'min:3', 'max:100'],

        ];

        if ($this->isMethod('post')) {
            $rules = [
                // Aturan validasi untuk atribut nim.
                'nim' => ['required', 'numeric', 'digits:9',  Rule::unique('mahasiswa') ],
            ];
        } else {
            $rules = [
                // Aturan validasi untuk atribut nim.
                'nim' => ['required', 'numeric', 'digits:9',  Rule::unique('mahasiswa')->ignore($request->id)],
            ];
        }

        $allKriteria = Kriteria::all();

        // Loop melalui data kriteria dan tambahkan aturan validasi untuk setiap kriteria
        foreach ($allKriteria as $kriteria) {
            $rules['kriteria_' . $kriteria->id] = 
            [
                'required',
                'numeric',
                'between:' . $kriteria->min_nilai . ',' . $kriteria->max_nilai,
            ];
        }

        return $rules;
    }

    public function messages()
    {

    return [
        'nama_mahasiswa.required' => 'Kolom Nama Mahasiswa harus diisi.',
        'nama_mahasiswa.min' => 'Kolom Nama Mahasiswa harus memiliki minimal :min karakter.',
        'nama_mahasiswa.max' => 'Kolom Nama Mahasiswa tidak boleh lebih dari :max karakter.',
        'nim.required' => 'Kolom NIM harus diisi.',
        'nim.digits' => 'Kolom NIM harus memiliki :digits digits.',
        'nim.numeric' => 'Kolom NIM harus berisi angka.',
        'nim.unique' => 'NIM sudah digunakan.',
        'kriteria_*.required' => 'Kolom nilai untuk kriteria ini harus diisi.',
        'kriteria_*.numeric' => 'Kolom nilai untuk kriteria ini harus berisi angka.',
        'kriteria_*.between' => 'Kolom nilai untuk kriteria ini harus berada dalam rentang :min sampai :max.'
    ];
    }
}
