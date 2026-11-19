<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'kode_arsip' => strtoupper(trim((string) $this->input('kode_arsip'))),
            'kerusakan_ids' => array_values(array_filter((array) $this->input('kerusakan_ids', []))),
        ]);
    }

    public function rules(): array
    {
        $id = $this->route('pita')?->id;

        return [
            'kode_arsip' => ['required', 'string', 'max:30', 'regex:/^[A-Z0-9\-\/]+$/',
                Rule::unique('pita', 'kode_arsip')->ignore($id)],
            'judul' => ['required', 'string', 'min:3', 'max:191'],
            'kategori_pita_id' => ['required', 'integer', 'exists:kategori_pita,id'],
            'tahun_rekaman' => ['nullable', 'integer', 'between:1900,' . now()->year],
            'durasi_menit' => ['nullable', 'integer', 'min:1', 'max:1440'],
            'kondisi' => ['required', Rule::in(array_keys(\App\Models\Pita::KONDISI))],
            'lokasi_simpan' => ['nullable', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
            'kerusakan_ids' => ['nullable', 'array'],
            'kerusakan_ids.*' => ['integer', 'exists:kerusakan,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_arsip' => 'kode arsip',
            'kategori_pita_id' => 'kategori',
            'tahun_rekaman' => 'tahun rekaman',
            'durasi_menit' => 'durasi',
            'kerusakan_ids' => 'kerusakan',
        ];
    }

    public function messages(): array
    {
        return [
            'kode_arsip.regex' => 'Kode arsip hanya boleh huruf kapital, angka, tanda "-" dan "/".',
            'kode_arsip.unique' => 'Kode arsip ini sudah terdaftar.',
            'judul.min' => 'Judul minimal 3 karakter.',
        ];
    }
}
