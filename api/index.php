<?php

// Create required directories in /tmp
$directories = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/public/storage'
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

// Override Laravel's storage path handling
putenv('STORAGE_PATH=/tmp/storage');
putenv('PUBLIC_PATH=/tmp/public');

// Load Laravel
require __DIR__ . '/../public/index.php';