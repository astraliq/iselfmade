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
        '@webroot' => '/www',
        '@web' => '/www',
        '@migrations' => '@app/migrations',
    ],
    'name' => 'iselfmade.ru',
    'language' => 'ru_RU',
    'components' => [
        'auth' => ['class' => \app\components\AuthComponent::class],
        'authManager' => ['class' => 'yii\rbac\DbManager'],
        'dao' => ['class' => \app\components\DAOComponent::class],
        'reports' => ['class' => \app\components\ReportsComponent::class],
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
            'timeZone' => 'Europe/Moscow',
//            'defaultTimeZone' => 'UTC',
            'defaultTimeZone' => 'Europe/Moscow',
            'locale' => 'ru-RU',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 60*24*60*60, // выход из системы через 60 дней, если неактивен
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
          'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'connect.smtp.bz',
                'username' => 'astral457@mail.ru',
                'password' => 'NBi8JnpKvYjL',
                'port' => '2525',
                'encryption' => 'tls',
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => file_exists(__DIR__ . '/db_real.php') ? false : true,
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
        'rbac' => ['class' => \app\components\RbacComponent::class],
        'task' => ['class' => \app\components\TasksComponent::class],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource'
                ],
            ],
        ],
        'userComp' => ['class' => \app\components\UserComponent::class],
        'encrypt' => ['class' => \app\components\EncryptComponent::class],
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
                'report'=>'task/report/',
                'archive'=>'task/archive/',
                'repeated'=>'task/repeated/',
                'profile'=>'user/update/',
                'task/img/'=>'img/',
                'profile/<id:\d+>'=>'user/update/',
                'confirm-mentor-email'=>'site/confirm-mentor-email',
                'grade-result'=>'site/grade-result',
                'check-reports'=>'report/check-reports/',
                'welcome'=>'task/welcome/',
                'goals'=>'task/goals/',
                'future'=>'task/future/',
                'possible'=>'task/possible/',
                'promises'=>'task/promises/',
                'group'=>'task/group/',
                'board'=>'task/board/',
                'mentor'=>'user/mentor/',
                'statistics'=>'user/statistics/',
                'policy'=>'site/policy/',
                [
                    'class'=>yii\rest\UrlRule::class,
                    'controller'=>'user-rest-api',
                    'pluralize'=>false
                ],
            ],
        ],
//        'session'=>[
//            'timeout' => 183*24*60*60, // время жизни сессии 6 месяцев
//        ],
        'timezones' => ['class' => \app\components\TimeZoneComponent::class],

    ],
    'params' => array_merge($params, [
        'monthsImenit' => [
            '1' => 'январь',
            '2' => 'февраль',
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
        ],
        'monthsShort' => [
            '1' => 'янв',
            '2' => 'фев',
            '3' => 'мар',
            '4' => 'апр',
            '5' => 'май',
            '6' => 'июн',
            '7' => 'июл',
            '8' => 'авг',
            '9' => 'сен',
            '10' => 'окт',
            '11' => 'ноя',
            '12' => 'дек',
        ],
        'links' => [
            'report' => '/report',
            'profile' => '/profile',
            'repeated' => '/repeated',
        ],
    ]),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '10.0.2.2'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '10.0.2.2'],
    ];
}

return $config;
