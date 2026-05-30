<?php

$compiledViewPath = '/tmp/storage/framework/views';
if (!is_dir($compiledViewPath)) {
    mkdir($compiledViewPath, 0755, true);
}

require __DIR__ . '/../public/index.php';