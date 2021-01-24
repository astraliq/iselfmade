<?php


namespace app\commands;


use app\base\BaseConsoleController;
use app\components\ArchiveTasksComponent;
use app\components\TasksComponent;
use app\models\ArchiveTasks;
use app\models\Tasks;
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

    /**
     * запускает скрипт создания повторяемых задач
     */
    public function actionRepeat() {
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $repeat = $comp->createRepeatedTasks();
        if ($repeat) {
            return ExitCode::OK;
        }

        echo print_r($repeat);

        return ExitCode::UNSPECIFIED_ERROR;
    }

    /**
     * запускает скрипт рассылки отчетов на электронную почту менторам
     */
    public function actionCuratorReports() {
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $sends = $comp->sendReportsToCurators();
        if ($sends) {
            return ExitCode::OK;
        }

        echo print_r($sends);

        return ExitCode::UNSPECIFIED_ERROR;
    }
}