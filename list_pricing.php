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
    
    $stmt = $pdo->query("SELECT * FROM pricing");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($rows as $row) {
        echo "ID: " . $row['id'] . " | Code: " . $row['product_code'] . " | Name: " . $row['name'] . " | Price: " . $row['price'] . "\n";
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
