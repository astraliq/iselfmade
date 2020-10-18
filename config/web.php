<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__ . '/db_real.php') ?
    (require __DIR__ . '/db_real.php') :
    (require __DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@filesWeb'=>'/files/',
    ],
    'name' => 'iSelfMade',
    'language' => 'ru_RU',
    'components' => [
        'auth' => ['class' => \app\components\AuthComponent::class],
        'authManager' => ['class' => 'yii\rbac\DbManager'],
        'dao' => ['class' => \app\Components\DAOComponent::class],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'eI-IGl_zVxsnssjqFoUUedH5VSkgfBiV',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'd.M.Y',
            'timeFormat' => 'H:i:s',
            'datetimeFormat' => 'php:d F Y H:i',
            'decimalSeparator' => '',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
//            'timeZone' => 'Europe/Moscow',
            'defaultTimeZone' => 'UTC',
            'locale' => 'ruRU',
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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'rbac' => ['class' => \app\Components\RbacComponent::class],
        'task' => ['class' => \app\Components\TasksComponent::class],
        'userComp' => ['class' => \app\Components\UserComponent::class],
        'encrypt' => ['class' => \app\Components\EncryptComponent::class],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'task/view/<id:\d+>'=>'task/view',
                'task/view/<user_id:\d+>/<id:\d+>'=>'task/view',
                'task/change/<id:\d+>'=>'task/change',
                'task/change/<user_id:\d+>/<id:\d+>'=>'task/change',
                'task/transfer/<type:\d+>'=>'task/transfer',
                'task/del/<id:\d+>'=>'task/del',
                'task/del/<user_id:\d+>/<id:\d+>'=>'task/del',
                'task/restore/<id:\d+>'=>'task/restore',
                'task/restore/<user_id:\d+>/<id:\d+>'=>'task/restore',
                'task/hard-del/<id:\d+>'=>'task/hard-del',
                'task/hard-del/<user_id:\d+>/<id:\d+>'=>'task/hard-del',
                'task/finish/<id:\d+>'=>'task/finish',
                'task/finish/<user_id:\d+>/<id:\d+>'=>'task/finish',
                'report'=>'task/report',
                'task/img/'=>'img/',
                'profile'=>'user/view/',
                'profile/<id:\d+>'=>'user/view/',
                'user/update/<id:\d+>'=>'user/update/',
                [
                    'class'=>yii\rest\UrlRule::class,
                    'controller'=>'user-rest-api',
                    'pluralize'=>false
                ],
            ],
        ],

    ],
    'params' => array_merge($params, ['monthsImenit' => [
        '1' => 'январь',
        '2' => 'феварль',
        '3' => 'март',
        '4' => 'апрель',
        '5' => 'май',
        '6' => 'июнь',
        '7' => 'июль',
        '8' => 'август',
        '9' => 'сентябрь',
        '10' => 'октябрь',
        '11' => 'ноябрь',
        '12' => 'декабрь',
    ]]),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
