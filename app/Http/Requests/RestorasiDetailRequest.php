<?php

namespace App\Http\Requests;

use App\Models\RestorasiDetail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestorasiDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahap' => ['required', Rule::in(array_keys(RestorasiDetail::TAHAP))],
            'tindakan' => ['required', 'string', 'min:3', 'max:191'],
            'tanggal' => ['required', 'date'],
            'durasi_menit' => ['required', 'integer', 'min:0', 'max:10080'],
            'hasil' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function attributes(): array
    {
        return ['durasi_menit' => 'durasi (menit)'];
    }
}
