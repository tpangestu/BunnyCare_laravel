<?php

// Create required directories for Laravel
$storageDirectories = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($storageDirectories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

// Create symlink for storage
if (!file_exists('/var/task/public/storage')) {
    symlink('/tmp/storage/app/public', '/var/task/public/storage');
}

require __DIR__ . '/../public/index.php';