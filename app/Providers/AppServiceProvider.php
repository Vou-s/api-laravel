<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config; // ✅ ini yang benar

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$clientKey    = config('midtrans.client_key');
        Config::$isProduction = filter_var(config('midtrans.is_production'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }
}
