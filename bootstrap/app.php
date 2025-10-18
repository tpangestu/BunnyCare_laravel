<?php

// PENTING: Buat direktori /tmp untuk Vercel
$tmpDirs = [
    '/tmp',
    '/tmp/cache',
    '/tmp/cache/data',
    '/tmp/views',
    '/tmp/sessions',
    '/tmp/storage',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->useStoragePath('/tmp/storage');

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
