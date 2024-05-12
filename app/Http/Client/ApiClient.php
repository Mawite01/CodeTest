<?php

declare(strict_types=1);

namespace App\Http\Client;

final class ApiClient extends ApiClient
{
    protected function getHeader(): array
    {
        return [
            'Accept' => 'application/json'
        ];
    }

    protected function getApiSetting(): array
    {
        return $this->apiSettings->getCmSettings();
    }

}
