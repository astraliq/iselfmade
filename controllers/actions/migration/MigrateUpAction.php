<?php

namespace app\controllers\actions\migration;

use yii\base\Action;
use yii\base\InvalidRouteException;
use yii\console\Application;
use yii\console\Exception;
use yii\web\HttpException;


class MigrateUpAction extends Action {
    /**
     * @throws Exception
     * @throws InvalidRouteException
     * @throws HttpException
     * /migration/migrate-up
     */
    public function run() {
        $oldApp = \Yii::$app;
        $config = require \Yii::getAlias('@app'). '/config/console.php';
        $params = [
            'migrationPath' => '@migrations',
            'interactive' => false,
        ];

        new Application($config);
        $runAction = \Yii::$app->runAction('migrate', $params);
        if (!$runAction) {
            throw new HttpException(501,'Не реализовано');
        }

//        echo '<pre>';
//        print_r($runAction);
//        echo '</pre>';
//        exit();
        \Yii::$app = $oldApp;
        return;
    }
}