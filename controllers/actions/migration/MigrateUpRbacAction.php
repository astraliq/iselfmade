<?php

namespace app\controllers\actions\migration;

use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\base\InvalidRouteException;
use yii\console\Application;
use yii\web\HttpException;

class MigrateUpRbacAction extends Action {
    /**
     * @throws InvalidRouteException
     * @throws InvalidConfigException
     * @throws HttpException
     * /migration/migrate-up
     */
    public function run() {
        $oldApp = \Yii::$app;
        $config = require \Yii::getAlias('@app'). '/config/console.php';
        $params = [
            'migrationPath' => '@yii/rbac/migrations',
            'interactive' => false,
        ];

        new Application($config);
        $runAction = \Yii::$app->runAction('migrate', $params);
        if (!$runAction) {
            throw new HttpException(501,'Не реализовано');
        }

        \Yii::$app = $oldApp;
        return;
    }
}