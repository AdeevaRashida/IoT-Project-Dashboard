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
    
    $akarMasalah = $e;
    while ($akarMasalah->getPrevious() !== null) {
        $akarMasalah = $akarMasalah->getPrevious();
    }

    echo json_encode([
        'status' => 'Topeng Berhasil Dibuka!',
        'error_saat_ini' => $e->getMessage(),
        'AKAR_MASALAH_ASLI' => $akarMasalah->getMessage(),
        'file_penyebab' => $akarMasalah->getFile(),
        'baris_ke' => $akarMasalah->getLine()
    ], JSON_PRETTY_PRINT);
    exit;
}