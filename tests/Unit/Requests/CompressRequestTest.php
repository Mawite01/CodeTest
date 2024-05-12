<?php

declare(strict_types=1);

namespace Tests\Unit\Requests;

use App\Http\Requests\CompressRequest;
use App\Http\Requests\FormRequest;
use Tests\TestCase;

/**
 * @copyright (c) 2024 - Hivelocity Inc, All Rights Reserved.
 * @package Tests\Unit\Requests;
 * @author Sophia
 */
class CompressRequestTest extends TestCase
{

    private CompressRequest $compressRequest;

    protected function setUp(): void
    {
        $this->compressRequest = new CompressRequest();
    }

    public function testRequestCanInitiate(): void
    {
        $this->assertInstanceOf(CompressRequest::class, $this->compressRequest);
        $this->assertInstanceOf(FormRequest::class, $this->compressRequest);
    }

    public function testRequestShouldAuthorize(): void
    {
        $result = $this->compressRequest->authorize();

        $this->assertTrue($result);
    }

    public function testRequestHaveRules(): void
    {
        $rules = $this->compressRequest->rules();
    
        $this->assertArrayHasKey('files', $rules);
        $this->assertArrayHasKey('dpi', $rules);
        $this->assertArrayHasKey('imageQuality', $rules);
        $this->assertArrayHasKey('mode', $rules);
        $this->assertArrayHasKey('imageQuality', $rules);
        $this->assertContains('required', $rules['files']);
        $this->assertContains('nullable', $rules['colorModel']);
        $this->assertContains('string', $rules['colorModel']);
        $this->assertContains('required', $rules['imageQuality']);
        $this->assertContains('integer', $rules['imageQuality']);
        $this->assertContains('min:1', $rules['imageQuality']);
        $this->assertContains('required', $rules['dpi']);
        $this->assertContains('integer', $rules['dpi']);
        $this->assertContains('min:1', $rules['dpi']);
        $this->assertContains('required', $rules['mode']);
    }
}
