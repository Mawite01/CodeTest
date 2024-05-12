<?php

declare(strict_types=1);

namespace Tests\Unit\Provider;

use App\Http\Repository\FileUpload\FileUploadRepository;
use App\Http\Repository\FileUpload\FileUploadRepositoryInterface;
use App\Providers\RepositoryServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @copyright (c) 2024 - Hivelocity Inc, All Right Reserved.
 * @package Tests\Unit\Provider.
 * @author Sophia
 */
class RepositoryServiceProviderTest extends TestCase
{
    private RepositoryServiceProvider $repositoryServiceProvider;

    protected Application $app;

    protected function setUp(): void
    {
        $this->app = Mockery::mock(Application::class);
        $this->repositoryServiceProvider = new RepositoryServiceProvider($this->app);
    }

    public function testServiceProviderCanInitiate(): void
    {
        $this->assertInstanceOf(RepositoryServiceProvider::class, $this->repositoryServiceProvider);
        $this->assertInstanceOf(ServiceProvider::class, $this->repositoryServiceProvider);
        $this->assertInstanceOf(DeferrableProvider::class, $this->repositoryServiceProvider);
    }

    public function testBindMenuServiceProviderCanRegister(): void
    {
        $this->ensureAppBindCall([
            FileUploadRepositoryInterface::class,
            FileUploadRepository::class
        ]);

        $result = $this->repositoryServiceProvider->register();

        $this->assertNull($result);
    }

    public function testServiceProviderCanProvide(): void
    {
        $result = $this->repositoryServiceProvider->provides();

        $this->assertCount(1, $result);
        $this->assertContains(FileUploadRepositoryInterface::class, $result);
    }

    protected function ensureAppBindCall(array $bindings): void
    {
        $this->app->shouldReceive('bind')
            ->with(...$bindings)
            ->once();
    }
}
