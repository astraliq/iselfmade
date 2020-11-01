<?php


namespace app\commands;


use app\base\BaseConsoleController;
use app\components\ArchiveTasksComponent;
use app\models\ArchiveTasks;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class TasksController extends BaseConsoleController {
    public function actionIndex() {
        echo "Контроллер задач запущен\n";

        return ExitCode::OK;
    }

    public function actionUpdate() {

        return ExitCode::OK;
    }

    /**
     * запускает скрипт перемещения в архивную таблицу всех заверешенных задач за предыдущий год
     */
    public function actionArchive() {
        $comp = \Yii::createObject(['class' => ArchiveTasksComponent::class,'modelClass' => ArchiveTasks::class]);
        $model = $comp->getModel();
//        if (!$comp->archiveLastYearTasks()) {
//            echo 'false';
//            return ExitCode::UNSPECIFIED_ERROR;

        echo $comp->archiveLastYearTasks($model);

        return ExitCode::OK;
    }
}