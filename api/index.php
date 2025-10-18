<?php

// Base paths
$basePath = '/var/task/user';
$publicPath = $basePath . '/public';
$tmpPath = '/tmp';

// Create required directories for Laravel
$storageDirectories = [
    $tmpPath . '/storage/app/public',
    $tmpPath . '/storage/framework/cache',
    $tmpPath . '/storage/framework/sessions',
    $tmpPath . '/storage/framework/views',
    $tmpPath . '/storage/logs',
];

// Ensure storage directories exist
foreach ($storageDirectories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

// Ensure public directory exists
if (!is_dir($publicPath)) {
    mkdir($publicPath, 0755, true);
}

// Create storage symlink if it doesn't exist
$storageTarget = $tmpPath . '/storage/app/public';
$storageLink = $publicPath . '/storage';

// Remove existing symlink or directory if it exists
if (is_link($storageLink)) {
    unlink($storageLink);
} elseif (is_dir($storageLink)) {
    rmdir($storageLink);
}

// Create new symlink
if (is_dir($storageTarget)) {
    symlink($storageTarget, $storageLink);
}

require __DIR__ . '/../public/index.php';