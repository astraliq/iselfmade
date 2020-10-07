<?php


namespace app\commands;


use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class TasksController extends Controller {
    public function actionIndex() {
        echo "Контроллер задач запущен\n";

        return ExitCode::OK;
    }

    public function actionUpdate() {

        return ExitCode::OK;
    }
}