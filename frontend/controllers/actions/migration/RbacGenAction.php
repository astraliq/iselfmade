<?php

namespace frontend\controllers\actions\migration;

use yii\base\Action;

class RbacGenAction extends Action {
    public function run() {
        \Yii::$app->rbac->generateRbac();
        \Yii::$app->rbac->addMentorRole();
        \Yii::$app->rbac->addReportPermission();
        \Yii::$app->rbac->addModeratorChildes();
        \Yii::$app->rbac->viewUserReportPermission();
        echo 'Done!';
        exit();
    }

}