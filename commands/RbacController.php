<?php


namespace app\commands;


use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class RbacController extends Controller {

    public function actionGen() {
        \Yii::$app->rbac->generateRbac();
    }

    public function actionSetAllRolesToUser() {
        if (\Yii::$app->rbac->setAllRolesToUser()) {
            $this->stdout("Произошла ошибка!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }
        $this->stdout("Done!\n", Console::BOLD);
        return ExitCode::OK;
    }

    public function actionSetAdminRole($id) {
        if (\Yii::$app->rbac->setAdminRole($id)) {
            $this->stdout("Done!\n", Console::BOLD);
            return ExitCode::OK;
        }
    }

    public function actionSetUserRole($id) {
        if (\Yii::$app->rbac->setUserRole($id)) {
            $this->stdout("Done!\n", Console::BOLD);
            return ExitCode::OK;
        }
    }



}