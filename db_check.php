<?php
$dbConfig = require(__DIR__ . '/config/db.php');
$dsn = $dbConfig['dsn'];
$user = $dbConfig['username'];
$pass = $dbConfig['password'];

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("DESCRIBE pricing");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Columns in pricing table:\n";
    print_r($columns);

    // Also fetch data to see if it's populated
    $stmt = $pdo->query("SELECT * FROM pricing");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Data in pricing table:\n";
    print_r($data);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
