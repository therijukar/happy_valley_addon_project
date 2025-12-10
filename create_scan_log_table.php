<?php
// Simple script to create table using Yii
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/config/web.php';

// Mock Application to access DB
new yii\web\Application($config);

echo "Creating scan_history table...\n";

$sql = "
CREATE TABLE IF NOT EXISTS `scan_history` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ticket_no` VARCHAR(255) NULL,
  `booking_id` INT(11) NULL,
  `customer_name` VARCHAR(255) NULL,
  `scan_status` VARCHAR(50) NOT NULL COMMENT 'Success, Invalid, Used',
  `scanned_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scanned_by` INT(11) NULL COMMENT 'Admin User ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

try {
    Yii::$app->db->createCommand($sql)->execute();
    echo "Table 'scan_history' created successfully.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
