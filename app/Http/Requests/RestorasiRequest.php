<?php

namespace App\Http\Requests;

use App\Models\Restorasi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestorasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'peralatan_ids' => array_values(array_filter((array) $this->input('peralatan_ids', []))),
            'biaya' => $this->normalizeBiaya((string) $this->input('biaya', '0')),
        ]);
    }

    /**
     * Menerima "1.850.000", "1.850.000,50", "1850000" maupun "1850000.00" (nilai dari database).
     */
    private function normalizeBiaya(string $raw): string
    {
        $raw = trim($raw);
        if (str_contains($raw, ',')) {
            // Format Indonesia: titik = pemisah ribuan, koma = desimal
            return str_replace(',', '.', str_replace('.', '', $raw));
        }
        if (substr_count($raw, '.') > 1) {
            // Titik berulang pasti pemisah ribuan
            return str_replace('.', '', $raw);
        }

        return $raw;
    }

    public function rules(): array
    {
        return [
            'pita_id' => ['required', 'integer', 'exists:pita,id'],
            'teknisi_id' => ['nullable', 'integer', 'exists:teknisi,id'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'status' => ['required', Rule::in(array_keys(Restorasi::STATUS))],
            'biaya' => ['required', 'numeric', 'min:0', 'max:999999999999'],
            'catatan' => ['nullable', 'string', 'max:2000'],
            'peralatan_ids' => ['nullable', 'array'],
            'peralatan_ids.*' => ['integer', 'exists:peralatan,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'pita_id' => 'pita',
            'teknisi_id' => 'teknisi',
            'tanggal_mulai' => 'tanggal mulai',
            'tanggal_selesai' => 'tanggal selesai',
            'peralatan_ids' => 'peralatan',
        ];
    }
}
