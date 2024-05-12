<?php

declare(strict_types=1);

namespace Tests\Unit\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileUploadController;
use App\Http\Repository\FileUpload\FileUploadRepositoryInterface;
use App\Http\Requests\CompressRequest;
use App\Http\Requests\DownloadRequest;
use App\Http\Requests\FileUploadRequest;
use PHPUnit\Framework\TestCase;
use Mockery;

class FileUploadControllerTest extends TestCase
{
    private FileUploadRepositoryInterface $fileUploadRepository;

    private FileUploadController $fileUploadController;

    private FileUploadRequest $fileUploadRequest;

    private CompressRequest $compressRequest;

    private DownloadRequest $downloadRequest;

    protected function setUp(): void
    {
        $this->fileUploadRequest = Mockery::mock(FileUploadRequest::class);
        $this->compressRequest = Mockery::mock(CompressRequest::class);
        $this->downloadRequest = Mockery::mock(DownloadRequest::class);
        $this->fileUploadRepository = Mockery::mock(FileUploadRepositoryInterface::class);
        $this->fileUploadController = new FileUploadController($this->fileUploadRepository);
    }

    public function testControllerCanInitiate(): void
    {
        $this->assertInstanceOf(FileUploadController::class, $this->fileUploadController);
        $this->assertInstanceOf(Controller::class, $this->fileUploadController);
    }
}
