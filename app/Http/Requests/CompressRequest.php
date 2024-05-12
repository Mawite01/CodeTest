<?php

declare(strict_types=1);

namespace App\Http\Requests;

class CompressRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'files' => ['required'],
            'colorModel' => ['nullable', 'string'],
            'imageQuality' => ['required', 'integer', 'min:1'],
            'dpi' => ['required', 'integer', 'min:1'],
        ];
    }
}
