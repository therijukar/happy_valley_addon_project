<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '0');
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
// Simplified router logic
$path = __DIR__ . '/web' . $uri;
if (is_file($path)) {
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $mimes = [
        'css' => 'text/css',
        'js'  => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg'=> 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'woff'=> 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
    ];
    if (isset($mimes[$ext])) {
        header("Content-Type: " . $mimes[$ext]);
    }
    return readfile($path);
}

if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false;
}

require __DIR__ . '/index.php';
