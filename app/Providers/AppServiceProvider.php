<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // No custom services are required for the scaffold.
    }

    public function boot(): void
    {
        // Shared boot logic can be added here later.
    }
}
