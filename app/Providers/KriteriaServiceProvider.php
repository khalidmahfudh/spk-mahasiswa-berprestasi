<?php

namespace App\Providers;

use App\Services\Impl\KriteriaServiceImpl;
use App\Services\KriteriaService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class KriteriaServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function provides(): array
    {
        return [KriteriaService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(KriteriaService::class, KriteriaServiceImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
