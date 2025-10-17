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
            
            // Set APP_URL dari request yang masuk
            if (isset($_SERVER['HTTP_HOST'])) {
                config(['app.url' => 'https://' . $_SERVER['HTTP_HOST']]);
            }
        }
    }
}