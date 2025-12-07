<?php

$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = getenv('DB_PORT') ?: '8889';
$db   = getenv('DB_NAME') ?: 'gohappyvalley_webnew';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'root';

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$host};port={$port};dbname={$db}",
    'username' => $user,
    'password' => $pass,
    'charset' => 'utf8',
];
