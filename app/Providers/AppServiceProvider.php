<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // Register services
    public function register(): void
    {
        //
    }

    // Bootstrap services
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
