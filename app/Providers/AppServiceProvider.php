<?php

namespace App\Providers;

use App\Interfaces\ApiAuthInterface;
use App\Interfaces\LoginInterface;
use App\Interfaces\RegisterInterface;
use App\Interfaces\VerifyEmailInterface;
use App\Services\Auth\ApiAuthService;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use App\Services\Auth\VerifyEmailService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $this->app->bind(ApiAuthInterface::class, ApiAuthService::class);
    }
}
