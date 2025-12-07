<?php
$config = require(__DIR__ . '/config/db.php');

// Parse DSN
preg_match('/host=([^;]+)/', $config['dsn'], $host_matches);
preg_match('/port=([^;]+)/', $config['dsn'], $port_matches);
preg_match('/dbname=([^;]+)/', $config['dsn'], $db_matches);

$host = $host_matches[1] ?? '127.0.0.1';
$port = $port_matches[1] ?? '8889';
$dbname = $db_matches[1] ?? 'gohappyvalley_webnew';
$user = $config['username'];
$pass = $config['password'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Add original_price
    try {
        $pdo->exec("ALTER TABLE `pricing` ADD COLUMN `original_price` DECIMAL(10,2) DEFAULT NULL AFTER `price`");
        echo "Added 'original_price' column.\n";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
            echo "'original_price' already exists.\n";
        } else {
            throw $e;
        }
    }

    // Add discount_label
    try {
        $pdo->exec("ALTER TABLE `pricing` ADD COLUMN `discount_label` VARCHAR(50) DEFAULT NULL AFTER `original_price`");
        echo "Added 'discount_label' column.\n";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
            echo "'discount_label' already exists.\n";
        } else {
            throw $e;
        }
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
