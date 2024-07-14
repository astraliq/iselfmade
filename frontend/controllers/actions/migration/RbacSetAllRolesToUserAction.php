<?php

namespace frontend\controllers\actions\migration;

use yii\base\Action;

class RbacSetAllRolesToUserAction extends Action {
    public function run() {
        if (!\Yii::$app->rbac->setAllRolesToUser()) {
            echo 'Ошибка setAllRolesToUser!';
            exit();
        }
        echo 'Done!';
        exit();
    }

}