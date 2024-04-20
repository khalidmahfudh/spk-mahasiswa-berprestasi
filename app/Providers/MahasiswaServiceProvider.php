<?php

namespace App\Providers;

use App\Services\Impl\MahasiswaServiceImpl;
use App\Services\MahasiswaService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class MahasiswaServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        MahasiswaService::class => MahasiswaServiceImpl::class
    ];

    public function provides(): array
    {
        return [MahasiswaService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
