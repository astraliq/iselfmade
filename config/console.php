<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__ . '/db.php') ?
    (require __DIR__ . '/db.php') :
    (require __DIR__ . '/db_real.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'authManager' => ['class' => 'yii\rbac\DbManager'],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'dao' => ['class' => \app\components\DAOComponent::class],
        'encrypt' => ['class' => \app\components\EncryptComponent::class],
        'formatter' => [
            'dateFormat' => 'd.M.Y',
            'timeFormat' => 'H:i:s',
            'datetimeFormat' => 'php:d F Y H:i',
            'decimalSeparator' => '',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
//            'timeZone' => 'Europe/Moscow',
            'defaultTimeZone' => 'UTC',
            'locale' => 'ru-RU',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'rbac' => ['class' => \app\components\RbacComponent::class],
        'db' => $db,
        'timezones' => ['class' => \app\components\TimeZoneComponent::class],
        'task' => ['class' => \app\components\TasksComponent::class],
    ],
    'params' => $params,

    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
