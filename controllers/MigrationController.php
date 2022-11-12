<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\migration\MigrateUpAction;
use app\controllers\actions\migration\MigrateUpRbacAction;
use app\controllers\actions\migration\RbacGenAction;
use app\controllers\actions\migration\RbacSetAllRolesToUserAction;
use yii\web\HttpException;

class MigrationController extends BaseController {
    public $layout = 'base';

    /**
     * @throws HttpException
     */
    public function actions() {
        if (YII_ENV_DEV) {
            return [
                'migrate-up' => ['class' => MigrateUpAction::class],
                'migrate-up-rbac' => ['class' => MigrateUpRbacAction::class],
                'rbac-gen' => ['class' => RbacGenAction::class],
                'rbac-set-all-roles-to-user' => ['class' => RbacSetAllRolesToUserAction::class],
            ];
        } else {
            throw new HttpException(404, 'Страница не найдена');
        }
    }

    public function beforeAction($action){
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

}