<?php

namespace console\controllers;


use frontend\base\BaseConsoleController;
use frontend\components\ArchiveTasksComponent;
use frontend\components\TasksComponent;
use frontend\models\ArchiveTasks;
use frontend\models\Tasks;
use yii\base\InvalidConfigException;
use yii\console\ExitCode;

class TasksController extends BaseConsoleController {
    public function actionIndex() {
        echo "Контроллер задач запущен\n";

        return ExitCode::OK;
    }

    public function actionUpdate() {

        return ExitCode::OK;
    }

    /**
     * Запускает скрипт перемещения в архивную таблицу всех заверешенных задач за предыдущий год
     * @throws InvalidConfigException
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

    /**
     * Запускает скрипт создания повторяемых задач
     * @throws InvalidConfigException
     */
    public function actionRepeat() {
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $repeat = $comp->createRepeatedTasks();
        if ($repeat) {
            return ExitCode::OK;
        }

        echo print_r($repeat);
        return ExitCode::UNSPECIFIED_ERROR;
    }

    /**
     * Запускает скрипт рассылки отчетов на электронную почту менторам
     * @throws InvalidConfigException
     */
    public function actionCuratorReports() {
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $sends = $comp->sendReportsToCurators();
        if ($sends) {
            return ExitCode::OK;
        }

        echo print_r($sends);

        return ExitCode::UNSPECIFIED_ERROR;
    }
}