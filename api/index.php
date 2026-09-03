<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Buat direktori penyimpanan sementara di /tmp
$tmpStorage = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($tmpStorage as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Set variabel lingkungan cache
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');

// Load Autoloader & Bootstrap Laravel 12
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Paksa seluruh sistem storage Laravel menggunakan /tmp
$app->useStoragePath('/tmp/storage');

// Jalankan Request
$request = Request::capture();
$response = $app->handle($request);
$response->send();