<?php

use Illuminate\Support\Str;

return [
    'default' => env('CACHE_DRIVER', 'array'), // PENTING: Gunakan 'array' untuk Vercel

    'stores' => [
        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'file' => [
            'driver' => 'file',
            'path' => env('CACHE_PATH', '/tmp/storage/framework/cache'), // Gunakan /tmp/storage/framework/cache
        ],

        // ... stores lainnya
    ],

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache_'),
];