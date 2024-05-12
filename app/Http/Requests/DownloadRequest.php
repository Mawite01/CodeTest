<?php

declare(strict_types=1);

namespace App\Http\Requests;

class DownloadRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'jobId' => ['required', 'string'],
        ];
    }

    public function prepareParam(): array
    {
        $param = \array_filter($this->validated());
        $param['mode'] = 'download';
        $param['action'] = 'downloadJobResult';
        
        return $param;
    }
}
