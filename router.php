<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '0');
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if (preg_match('#^/assets/#', $uri)) {
    $path = __DIR__ . '/web' . $uri;
    if (is_file($path)) {
        return readfile($path);
    }
}
if (preg_match('#^/css/#', $uri)) {
    $path = __DIR__ . '/web' . $uri;
    if (is_file($path)) {
        return readfile($path);
    }
}
if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false;
}
require __DIR__ . '/index.php';
