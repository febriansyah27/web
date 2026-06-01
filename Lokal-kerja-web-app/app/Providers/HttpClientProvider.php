<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class HttpClientProvider extends ServiceProvider
{
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
        // For local development, disable SSL verification if certificate issues occur
        if (app()->environment('local') && env('DISABLE_SSL_VERIFICATION', false)) {
            Http::macro('withoutVerification', function () {
                return Http::withoutVerifying();
            });
        }
    }
}
