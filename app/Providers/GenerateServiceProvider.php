<?php

namespace App\Providers;

use App\Services\Impl\GenerateServiceImpl;
use App\Services\GenerateService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class GenerateServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function provides(): array
    {
        return [GenerateService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(GenerateService::class, GenerateServiceImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
