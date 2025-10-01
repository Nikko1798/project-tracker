<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

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
        //
         // Trust proxy headers (important if using HTTPS offloaded by proxy)
        
        if ($this->app->environment('production')) {
            Request::setTrustedProxies(
                request()->getClientIp() ? [request()->getClientIp()] : [],
                Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_PROTO
            );
            URL::forceScheme('https');
        }
    }
}
