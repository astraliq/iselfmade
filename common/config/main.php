<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_HOST_PORT'] . ';dbname=iselfmade',
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8',

            'enableSchemaCache' => true,
            'schemaCacheDuration' => 7200,
            // Name of the cache component used to store schema information
            'schemaCache' => 'frontendCache',

            'enableQueryCache' => true,
            'queryCacheDuration' => 7200,
            'queryCache' => 'frontendCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host'     => $_ENV['MAILER_HOST'],
                'port'     => $_ENV['MAILER_PORT'], // 25 | 465 | 587
                'username' => $_ENV['MAILER_USERNAME'],
                'password' => $_ENV['MAILER_PASSWORD'],
                'encryption' => 'ssl', // tls | ssl
            ],
            'viewPath' => '@common/mail',
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
];
