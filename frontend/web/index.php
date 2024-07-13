<?php
require __DIR__ . '/../../vendor/autoload.php';
try {
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
    $dotenv->load();
    $dotenv->required([
        'COOKIE_VALIDATION_KEY',

        'DB_HOST',
        'DB_DBNAME',
        'DB_USERNAME',
        'DB_PASSWORD',
    ])->notEmpty();

    $dotenv->required([
        'YII_DEBUG',
    ])->isBoolean();
    $dotenv->required('YII_ENV')->allowedValues(['prod', 'test', 'dev']);
} catch (Dotenv\Exception\ValidationException $e) {
    echo $e->getMessage();
    exit();
}

defined('YII_DEBUG') or define('YII_DEBUG', $_ENV['YII_DEBUG']);
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV']);

require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$commonMainLocal = __DIR__ . '/../../common/config/main-local.php';
$frontendMainLocal = __DIR__ . '/../config/main-local.php';
$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    file_exists($commonMainLocal) ? require $commonMainLocal : [],
    require __DIR__ . '/../config/main.php',
    file_exists($frontendMainLocal) ? require $frontendMainLocal : []
);

(new yii\web\Application($config))->run();
