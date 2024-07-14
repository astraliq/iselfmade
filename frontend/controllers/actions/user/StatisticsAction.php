<?php


namespace frontend\controllers\actions\user;


use frontend\components\ReportCommentsComponent;
use frontend\components\ReportsComponent;
use frontend\components\TasksComponent;
use frontend\components\UserComponent;
use frontend\models\ReportComments;
use frontend\models\Tasks;
use frontend\models\User;
use frontend\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class StatisticsAction extends Action {
    public function run() {

        if (\Yii::$app->user->isGuest || !\Yii::$app->user->can('curator')) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $compReports = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $modelReports = $compReports->getModel();
        $compTasks = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $modelTasks = $compTasks->getModel();
        $compUsers = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $modelUsers = $compUsers->getModel();
        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);

        $today = date('d.m.Y');
        $todayUTC = date('Y-m-d');

        $totalCountUsers = $compUsers->getTotalCountUsers();
        $lastDayCountUsers = $compUsers->getLastDayCountUsers();
        $allUsersList = $compUsers->getUsersList();
        $countReports =  $compReports->getCountReportsToCheck();
        $reportsCountReal = $countReports == 0 ? 0 : $countReports;
        $lastReportDate = $compReports->getLastReportDate();

        return $this->controller->render('statistics', [
            'totalCountUsers' => $totalCountUsers,
            'lastDayCountUsers' => $lastDayCountUsers,
            'allUsersList' => $allUsersList,
            'reportsCount' => $reportsCountReal,
            'lastReportDate' => $lastReportDate,
        ]);

    }
}