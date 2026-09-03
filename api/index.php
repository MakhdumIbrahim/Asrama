<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Register shutdown function to catch fatal PHP errors before function invocation crashes
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
        if (!headers_sent()) {
            http_response_code(500);
        }
        echo '<div style="padding:20px; font-family:sans-serif; background:#fff0f0; border:2px solid red; margin:20px; border-radius:8px;">';
        echo '<h2 style="color:red; margin-top:0;">Fatal PHP Error on Vercel</h2>';
        echo '<p><strong>Pesan Error:</strong> ' . htmlspecialchars($error['message']) . '</p>';
        echo '<p><strong>File Target:</strong> ' . htmlspecialchars($error['file']) . ' (Baris ' . $error['line'] . ')</p>';
        echo '</div>';
    }
});

try {
    // 1. Buat direktori penyimpanan sementara di /tmp (Vercel serverless read-only filesystem workaround)
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

    // 2. Set variabel lingkungan cache ke /tmp
    putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
    putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
    putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php');
    putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');
    putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');

    // 3. Autoload & Bootstrap Laravel
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->useStoragePath('/tmp/storage');

    // 4. Tangani Request HTTP
    $app->handleRequest(Request::capture());

} catch (\Throwable $e) {
    if (!headers_sent()) {
        http_response_code(500);
    }
    echo '<div style="padding:20px; font-family:sans-serif; background:#fff0f0; border:2px solid red; margin:20px; border-radius:8px;">';
    echo '<h2 style="color:red; margin-top:0;">Laravel Runtime Exception on Vercel</h2>';
    echo '<p><strong>Pesan Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><strong>File Target:</strong> ' . htmlspecialchars($e->getFile()) . ' (Baris ' . $e->getLine() . ')</p>';
    echo '<h3>Stack Trace:</h3>';
    echo '<pre style="background:#eee; padding:10px; overflow:auto; max-height:300px;">' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</div>';
}