<?php
$params = require(__DIR__ . '/params.php');
use kartik\mpdf\Pdf;
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
    		'serviceendpointcomp'=>[
    				'class' => 'app\components\ServiceEndpointComponent',
    		],
		    'pdf' => [
			    'class' => Pdf::class,
			    'format' => Pdf::FORMAT_A4,
			    'orientation' => Pdf::ORIENT_PORTRAIT,
			    'destination' => Pdf::DEST_BROWSER,
			    // refer settings section for all configuration options
		    ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tests',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'gohappyvalley.com',
                'username' => 'booking@gohappyvalley.com',
                'password' => 'Royal@1234',
                'port' => 465, // SMTP port
                'encryption' => 'ssl', // Encryption method (SSL/TLS)
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                /* [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','trace','info'],
                ], */
            		[
            		'class' => 'yii\log\FileTarget',
            		'levels' => ['error','info'],
            		'categories' => ['service'],
            		'logFile' => '@app/runtime/logs/webservice/service.log',
            		'maxFileSize' => 1024*3,
            		'maxLogFiles' => 30,
            		],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        'assets/admin/js/jquery-2.1.1.min.js',
                    ],
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ]
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),


        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
	            '' => 'cms/',
                'picnic-spots' => 'cms/picnic-spots',
                'restaurant' => 'cms/restaurant',
                'banquet' => 'cms/banquet',
	            'theatre' => 'cms/theatre',
                'striking-car' => 'cms/striking-car',
                'boating' => 'cms/boating',
                'children-boating' => 'cms/children-boating',
                'children-pool' => 'cms/children-pool',
                'happy-bees' => 'cms/happy-bees',
                'jumping-house' => 'cms/jumping-house',
                'horse-train' => 'cms/horse-train',
                'gaming' => 'cms/gaming',
                'privacy' => 'cms/privacy',
                'terms' => 'cms/terms',
                'events' => 'cms/events',
                'contact' => 'cms/contact',
                'waterworld' => 'cms/waterworld',
                'POST webhook' => 'webhook/handle',

            ],
        ],
        
    ],
    //'defaultRoute' => 'index/index',
    'params' => $params,
	'modules' => [
		'admin' => [
				'class' => 'app\modules\admin\Module',
			],
		],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
