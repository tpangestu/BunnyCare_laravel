<?php

return [
    'paths' => [
        resource_path('views'),
    ],

    // PENTING: Gunakan /tmp untuk Vercel
    'compiled' => env('VIEW_COMPILED_PATH', '/tmp/storage/framework/views'),
];