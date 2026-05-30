<?php
$_SERVER['HTTP_ACCEPT'] = 'application/json';

$storagePath = '/tmp/storage';

$directories = [
    $storagePath . '/app',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

$_ENV['APP_STORAGE'] = $storagePath;
putenv('APP_STORAGE=' . $storagePath);

$_ENV['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';
putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');

require __DIR__ . '/../public/index.php';