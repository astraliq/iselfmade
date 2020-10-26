<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__ . '/db_real.php') ?
    (require __DIR__ . '/db_real.php') :
    (require __DIR__ . '/db.php');

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
        'dao' => ['class' => \app\Components\DAOComponent::class],
        'encrypt' => ['class' => \app\Components\EncryptComponent::class],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'rbac' => ['class' => \app\Components\RbacComponent::class],
        'db' => $db,
        'timezones' => ['class' => \app\Components\TimeZoneComponent::class],
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
