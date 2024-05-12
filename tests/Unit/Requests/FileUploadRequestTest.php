<?php

declare(strict_types=1);

namespace Tests\Unit\Requests;

use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\FormRequest;
use Tests\TestCase;

/**
 * @copyright (c) 2024 - Hivelocity Inc, All Rights Reserved.
 * @package Tests\Unit\CafeVote\Admin\Vote\Requests.
 * @author Sophia
 */
class FileUploadRequestTest extends TestCase
{

    private FileUploadRequest $fileUploadRequest;

    protected function setUp(): void
    {
        $this->fileUploadRequest = new FileUploadRequest();
    }

    public function testRequestCanInitiate(): void
    {
        $this->assertInstanceOf(FileUploadRequest::class, $this->fileUploadRequest);
        $this->assertInstanceOf(FormRequest::class, $this->fileUploadRequest);
    }

    public function testRequestShouldAuthorize(): void
    {
        $result = $this->fileUploadRequest->authorize();

        $this->assertTrue($result);
    }

    public function testRequestHaveRules(): void
    {
        $rules = $this->fileUploadRequest->rules();
    
        $this->assertArrayHasKey('file', $rules);
        $this->assertContains('array', $rules['file']);
        $this->assertContains('nullable', $rules['file']);
    }
}
