<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Repository\FileUpload\FileUploadRepositoryInterface;
use App\Http\Requests\CompressRequest;
use App\Http\Requests\DownloadRequest;
use App\Http\Requests\FileUploadRequest;
use App\Http\Resources\CompressPdfResource;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class FileUploadController extends Controller
{
    private FileUploadRepositoryInterface $fileUploadRepository;

    public function __construct(FileUploadRepositoryInterface $fileUploadRepository)
    {
        $this->fileUploadRepository = $fileUploadRepository;
    }

    public function upload(FileUploadRequest $request): CompressPdfResource
    {
        try {
            $result = $this->fileUploadRepository->fileUpload($request->file);
           
            $cookieHeader = $result->cookies()->toArray();
            Session::put('cookie_name', $cookieHeader[0]['Name']);
            Session::put('cookie_value', $cookieHeader[0]['Value']);
            
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }

        return new CompressPdfResource(json_decode($result->body()));
    }

    public function compress(CompressRequest $request): CompressPdfResource
    {
        try {
            $compress = $this->fileUploadRepository->compress($request->validated());
            $responseData = json_decode($compress->body(), true);
            $result = $this->fileUploadRepository->startJob($responseData);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return new CompressPdfResource(json_decode($result->body()));
    }

    public function download(DownloadRequest $request)
    {
        try{
            $response = $this->fileUploadRepository->download($request->prepareParam());
            
            $extention = $request->count > 1 ? 'zip' : 'pdf';

            $filename = 'downloaded_file.' . $extention;
           
        }catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
        
        return response()->stream(function () use ($response) {
            echo $response->body();
        }, 200, $this->getHeaders($response, $filename));
    }

    private function getHeaders(Response $response, string $filename): array
    {
        return  [
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Type' => $response->header('Content-Type'),
            'Content-Length' => $response->header('Content-Length'),
        ];
    }
}
