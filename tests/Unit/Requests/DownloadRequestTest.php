<?php

declare(strict_types=1);

namespace Tests\Unit\Requests;

use App\Http\Requests\DownloadRequest;
use App\Http\Requests\FormRequest;
use Tests\TestCase;

/**
 * @copyright (c) 2024 - Hivelocity Inc, All Rights Reserved.
 * @package Tests\Unit\Requests;
 * @author Sophia
 */
class DownloadRequestTest extends TestCase
{

    private DownloadRequest $downloadRequest;

    protected function setUp(): void
    {
        $this->downloadRequest = new DownloadRequest();
    }

    public function testRequestCanInitiate(): void
    {
        $this->assertInstanceOf(DownloadRequest::class, $this->downloadRequest);
        $this->assertInstanceOf(FormRequest::class, $this->downloadRequest);
    }

    public function testRequestShouldAuthorize(): void
    {
        $result = $this->downloadRequest->authorize();

        $this->assertTrue($result);
    }

    public function testRequestHaveRules(): void
    {
        $rules = $this->downloadRequest->rules();
    
        $this->assertArrayHasKey('jobId', $rules);
        $this->assertContains('required', $rules['jobId']);
        $this->assertContains('string', $rules['jobId']);
    }
}
