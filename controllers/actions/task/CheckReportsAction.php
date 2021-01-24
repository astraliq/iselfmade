<?php


namespace app\controllers\actions\task;


use app\components\ReportsComponent;
use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\Tasks;
use app\models\User;
use app\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class CheckReportsAction extends Action {
    public function run() {
        $admin = false;
        if (\Yii::$app->user->isGuest || !\Yii::$app->user->can('curator')) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $comp = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $model = $comp->getModel();
        $compTasks = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $modelTasks = $compTasks->getModel();
        $compUsers = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $modelUsers = $compUsers->getModel();

        $today = date('d.m.Y');
        $todayUTC = date('Y-m-d');

        // первый отчет
        $report = $comp->getFirstUserReport();
        $reportUser = $modelUsers->findOne(['id' => $report->user_id]);
        $userReportTasks = $compTasks->getTasksByDateAndUserId($reportUser->id, $report->date);
        $reportsCount = $comp->getCountReportsToCheck() - 1;
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $tasks;
        }

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('check_reports', [
            'user' => $reportUser,
            'tasks' => $userReportTasks,
            'date' => (new \DateTime($report->date))->format('d.m.Y'),
            'report' => $report,
            'reportsCount' => $reportsCount,
            'notifConfEmail' => $notifConfEmail,
        ]);

    }
}