<?php

namespace App\Providers;

use App\Services\Impl\UsersServiceImpl;
use App\Services\UsersService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class UsersServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function provides(): array
    {
        return [UsersService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UsersService::class, UsersServiceImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
