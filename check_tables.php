<?php
$config = require 'config/db.php';
try {
    $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $tables = ['user', 'otp_store', 'booking'];
    foreach($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if($stmt->rowCount() > 0) {
            echo "Table '$table' EXISTS.\n";
        } else {
            echo "Table '$table' MISSING.\n";
        }
    }
} catch(PDOException $e) {
    echo "DB Connection Failed: " . $e->getMessage() . "\n";
}
