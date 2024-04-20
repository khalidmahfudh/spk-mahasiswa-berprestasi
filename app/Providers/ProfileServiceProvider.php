<?php

namespace App\Providers;

use App\Services\Impl\ProfileServiceImpl;
use App\Services\ProfileService;
use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    public function provides(): array
    {
        return [ProfileService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ProfileService::class, ProfileServiceImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
