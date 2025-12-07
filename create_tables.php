<?php
// Load DB config
$dbConfig = require(__DIR__ . '/config/db.php');

// Extract DSN info
$dsn = $dbConfig['dsn'];
$username = $dbConfig['username'];
$password = $dbConfig['password'];

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create user table
    $sqlUser = "CREATE TABLE IF NOT EXISTS `user` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `phone` VARCHAR(20) NOT NULL UNIQUE,
        `auth_key` VARCHAR(32) NOT NULL,
        `access_token` VARCHAR(255) DEFAULT NULL,
        `status` SMALLINT NOT NULL DEFAULT 10,
        `created_at` INT NOT NULL,
        `updated_at` INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $pdo->exec($sqlUser);
    echo "Table 'user' created or already exists.\n";

    // Create otp_store table
    $sqlOtp = "CREATE TABLE IF NOT EXISTS `otp_store` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `phone` VARCHAR(20) NOT NULL,
        `otp` VARCHAR(6) NOT NULL,
        `expiry` INT NOT NULL,
        `is_verified` TINYINT(1) DEFAULT 0,
        `created_at` INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $pdo->exec($sqlOtp);
    echo "Table 'otp_store' created or already exists.\n";
    
    // Add user_id column to booking table if not exists
    $checkCol = "SHOW COLUMNS FROM `booking` LIKE 'user_id'";
    $stmt = $pdo->query($checkCol);
    if ($stmt->rowCount() == 0) {
        $sqlAlter = "ALTER TABLE `booking` ADD COLUMN `user_id` INT DEFAULT NULL AFTER `id`";
        $pdo->exec($sqlAlter);
        echo "Column 'user_id' added to 'booking' table.\n";
    } else {
        echo "Column 'user_id' already exists in 'booking' table.\n";
    }

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage() . "\n");
}
