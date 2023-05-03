<?php

require_once 'Custom.php';
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Ikatan Pesantren Indonesia',
    'timeZone' => 'Asia/Jakarta',
    'language' => 'id_ID',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => Yii::$app->params['recaptcha2.clientKey'],
            'secretV2' => Yii::$app->params['recaptcha2.secretKey'],
            'siteKeyV3' => Yii::$app->params['recaptcha3.clientKey'],
            'secretV3' => Yii::$app->params['recaptcha3.secretKey'],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'secret',
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
        'formatter' => [
            'class' => \app\formatter\CustomFormatter::class,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',

                    ],
                ],
            ],
        ],
        /*        'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
        'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com',
        'username' => 'ds.popcafe@gmail.com',
        'password' => 'ss',
        'port' => '587',
        'encryption' => 'tls'
        ],
        ],
        */
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'email@emalil.com',
                'password' => '',
                'port' => '587',
                'encryption' => 'tls'
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                //User
                'user/login' => '/user/login',
                'user/register' => '/user/register',
                'user/check-otp' => '/user/check-otp',
                'user/refresh-otp' => '/user/refresh-otp',
                'about' => 'home/about',
                'detail-berita' => 'home/detail-berita',
                'unduh-file-uraian' => 'home/unduh-file-uraian',
                'registrasi' => 'home/registrasi',
                'login' => 'home/login',
                'lupa-password' => 'site/lupa-password',
                //notifikasi
                'notifikasi/all' => 'notifikasi/all',
                'notifikasi/detail/<unique_id:[\w\_\-]+>' => 'notifikasi/detail',
                // 
                '<controller:[\w\_\-]+>/<id:\d+>' => '<controller>/view',
                '<controller:[\w\_\-]+>/<action:[\w\_\-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w\_\-]+>/<action:[\w\_\-]+>' => '<controller>/<action>',
            ),
        ],
        /*
        'view' => [
        'theme' => [
        'pathMap' => [
        '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
        ],
        ],
        ],
        */
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []

        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module'
        ]
    ],
    'params' => $params,
    'defaultRoute' => "home",
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;