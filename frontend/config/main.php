<?php
$commonParamsLocal = __DIR__ . '/../../common/config/params-local.php';
$paramsLocal = __DIR__ . '/params-local.php';
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    file_exists($commonParamsLocal) ? require $commonParamsLocal : [],
    require __DIR__ . '/params.php',
    file_exists($paramsLocal) ? require $paramsLocal : []
);

return [
    'id' => 'iselfmade',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'auth' => ['class' => \frontend\components\AuthComponent::class],
        'authManager' => ['class' => \yii\rbac\DbManager::class],
        'reports' => ['class' => \frontend\components\ReportsComponent::class],
        'rbac' => ['class' => \frontend\components\RbacComponent::class],
        'task' => ['class' => \frontend\components\TasksComponent::class],
        'userComp' => ['class' => \frontend\components\UserComponent::class],
        'encrypt' => ['class' => \frontend\components\EncryptComponent::class],
        'timezones' => ['class' => \frontend\components\TimeZoneComponent::class],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey'    => $_ENV['COOKIE_VALIDATION_KEY'],
            'enableCookieValidation' => true,
            'enableCsrfValidation'   => true,
            'enableCsrfCookie'   => true,
        ],
        'response' => [
            'formatters' => ['sse' => \frontend\components\SSEFormatter::class],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'authTimeout'     => 60*24*60*8, // выход из системы через 8 дней, если неактивен
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'iselfmade-frontend',
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
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
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
                'php-info'=>'site/php-info',
                [
                    'class'=>yii\rest\UrlRule::class,
                    'controller'=>'user-rest-api',
                    'pluralize'=>false
                ],
            ],
        ],
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
    ],
    'params' => $params,
];
