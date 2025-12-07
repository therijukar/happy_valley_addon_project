<?php
$db = require(__DIR__ . '/config/db.php');
try {
    $dsn = $db['dsn'];
    $username = $db['username'];
    $password = $db['password'];
    $pdo = new PDO($dsn, $username, $password);
    $stmt = $pdo->query("SELECT otp FROM otp_store WHERE phone='1234567890' ORDER BY id DESC LIMIT 1");
    $otp = $stmt->fetchColumn();
    echo $otp;
} catch (Exception $e) {
    echo "";
}
