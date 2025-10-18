<?php

// PENTING: Buat direktori /tmp untuk Vercel
$tmpDirs = [
    '/tmp',
    '/tmp/cache',
    '/tmp/cache/data',
    '/tmp/views',
    '/tmp/sessions',
    '/tmp/storage',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Set storage path ke /tmp untuk Vercel
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    // Override storage_path helper
    app()->useStoragePath('/tmp/storage');
}

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;