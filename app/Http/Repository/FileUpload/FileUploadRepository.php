<?php

declare(strict_types=1);

namespace App\Http\Repository\FileUpload;

use App\Http\Repository\ApiRepository;
use Illuminate\Http\Client\Response;

class FileUploadRepository extends ApiRepository implements FileUploadRepositoryInterface
{
    public function fileUpload(array $params = []): Response
    {
        $endPoint = 'upload';

        return $this->upload($endPoint, $params);
    }

    public function compress(array $params = []): Response
    {
        $endPoint = 'compressPdf';

        return $this->callApi('POST', $endPoint, $params);
    }

    public function startJob(array $params = []): Response
    {
        $params = array_merge($params, ['action' => 'getStatus']);
        
        return $this->callApi('GET', '', $params);
    }

    public function download(array $params): Response
    {
        return $this->callApi('GET', '', $params);
    }
}
