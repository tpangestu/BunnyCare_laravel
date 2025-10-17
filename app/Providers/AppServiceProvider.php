<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Force HTTPS di production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}