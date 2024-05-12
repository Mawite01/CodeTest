<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Repository\FileUpload\FileUploadRepository;
use App\Http\Repository\FileUpload\FileUploadRepositoryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            FileUploadRepositoryInterface::class,
            FileUploadRepository::class
        );
    }

    public function provides(): array
    {
        return [FileUploadRepositoryInterface::class];
    }
}
