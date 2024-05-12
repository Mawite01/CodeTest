<?php

declare(strict_types=1);

namespace App\Http\Repository\FileUpload;

use Illuminate\Http\Client\Response;

interface FileUploadRepositoryInterface
{
    public function fileUpload(array $params = []): Response;

    public function compress(array $params = []): Response;

    public function startJob(array $params = []): Response;

    public function download(array $params): Response;
}