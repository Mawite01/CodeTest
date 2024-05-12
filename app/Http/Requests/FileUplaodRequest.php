<?php

declare(strict_types=1);

namespace App\Http\Requests;


class FileUplaodRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'file' => 'nullable|array|min:1',
            'file.*' => 'file|mimes:pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'file.array' => 'The file field must be an array.',
            'file.min' => 'Please upload at least one file.',
            'file.*.file' => 'All uploaded files must be valid files.',
            'file.*.mimes' => 'All uploaded files must be in PDF format.',
            'file.*.max' => 'All uploaded files must be less than 2MB in size.',
        ];
    }
}
