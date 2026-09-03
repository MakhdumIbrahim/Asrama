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

require __DIR__ . '/../vendor/autoload.php';

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->useStoragePath('/tmp/storage');

    $request = Request::capture();
    $response = $app->handle($request);
    $response->send();
} catch (\Throwable $e) {
    // Tangkap error PHP asli agar tidak tertutup layar 500 Vercel
    http_response_code(500);
    echo '<div style="padding:20px; font-family:sans-serif; background:#fff0f0; border:2px solid red; margin:20px; border-radius:8px;">';
    echo '<h2 style="color:red; margin-top:0;">Laravel Runtime Error</h2>';
    echo '<p><strong>Pesan Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><strong>File Target:</strong> ' . htmlspecialchars($e->getFile()) . ' (Baris ' . $e->getLine() . ')</p>';
    echo '<h3>Stack Trace:</h3>';
    echo '<pre style="background:#eee; padding:10px; overflow:auto; max-height:300px;">' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</div>';
}