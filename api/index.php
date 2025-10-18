<?php

// Create cache directory
if (!is_dir('/tmp/storage/framework/cache')) {
    mkdir('/tmp/storage/framework/cache', 0755, true);
}

// Set cache path
putenv('APP_CONFIG_CACHE=/tmp/storage/framework/cache/config.php');
putenv('APP_SERVICES_CACHE=/tmp/storage/framework/cache/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/storage/framework/cache/packages.php');

// Load Laravel
require __DIR__ . '/../public/index.php';