<?php
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

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'Pesan Error Asli Terbongkar!',
        'error_message' => $e->getMessage(),
        'file_penyebab' => $e->getFile(),
        'baris_ke' => $e->getLine()
    ], JSON_PRETTY_PRINT);
    exit;
}