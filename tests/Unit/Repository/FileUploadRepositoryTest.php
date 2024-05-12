<?php

namespace Tests\Unit\Repository;

use App\Http\Repository\FileUpload\FileUploadRepository;
use App\Http\Repository\FileUpload\FileUploadRepositoryInterface;
use Mockery;
use Tests\TestCase;

class FileUploadRepositoryTest extends TestCase
{
    private FileUploadRepository $fileUploadRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fileUploadRepository = new FileUploadRepository();
    }

    public function testRepositoryCanInitiate(): void
    {
        $this->assertInstanceOf(FileUploadRepository::class, $this->fileUploadRepository);
        $this->assertInstanceOf(FileUploadRepositoryInterface::class, $this->fileUploadRepository);
    }

}
