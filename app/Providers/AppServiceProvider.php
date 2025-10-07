<?php

namespace App\Providers;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

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
       // Rate limiter untuk form contact
    RateLimiter::for('contact_form', function (Request $request) {
        if ($request->user()) {
            // Kalau user login → 10x per menit
            return Limit::perMinute(10)->by($request->user()->id);
        }

        // Kalau guest (belum login) → 5x per menit berdasarkan IP
        return Limit::perMinute(5)->by($request->ip());
    });
    }
}
