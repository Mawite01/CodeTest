<?php

declare(strict_types=1);

namespace App\Http\Repository;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;

abstract class ApiRepository
{
    private $baseUrl;

    private $domain;

    public function __construct()
    {
        $this->baseUrl = Config::get('api.base_url');
        $this->domain = Config::get('api.domain');
    }

    public function upload(string $endPoint = '', $params = []): Response
    {
        try {
            return Http::attach($this->attachFiles($params))->post(
                $this->baseUrl . $endPoint
            );
        } catch (Exception $e) {
            throw new Exception('API request failed.');
        }
    }

    public function callApi(string $method, string $endPoint = '', $params = []): Response
    {
        try {
            return Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->withCookies($this->getCookie(), $this->domain)
                ->{$method}($this->baseUrl . $endPoint, $params);
        } catch (Exception $e) {
            throw new Exception('API Call Failed');
        }
    }

    private function attachFiles(array $params): array
    {
        return array_map(function ($file) {
            return [
                'name' => 'files[]',
                'contents' => fopen($file->getPathname(), 'r'),
                'filename' => $file->getClientOriginalName(),
            ];
        }, $params);
    }

    private function getCookie(): array
    {
        return  [
            Session::get('cookie_name') => Session::get('cookie_value'),
        ];
    }
}
