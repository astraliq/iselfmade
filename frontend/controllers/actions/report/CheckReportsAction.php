<?php


namespace frontend\controllers\actions\report;


use frontend\components\ReportCommentsComponent;
use frontend\components\ReportsComponent;
use frontend\components\TasksComponent;
use frontend\components\UserComponent;
use frontend\models\ReportComments;
use frontend\models\Tasks;
use common\models\User;
use frontend\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class CheckReportsAction extends Action {
    public function run($id=null) {
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
        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);

        $today = date('d.m.Y');
        $todayUTC = date('Y-m-d');

        // первый отчет пользователя
        if ($id) {
            $report = $comp->getUserReportById($id);
        } else {
            $report = $comp->getFirstUserReport();
        }
        $reportUser = $modelUsers->findOne(['id' => $report->user_id]);

        $selfUser = $modelUsers->findOne(['id' => \Yii::$app->user->getId()]);
        $userReportTasks = $compTasks->getTasksByDateAndUserId($reportUser->id, $report->date);

        $count =  $comp->getCountReportsToCheck();
        $reportsCount = $count == 0 ? 0 : $count -1;
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $tasks;
        }

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        $comments = $compComments->getReportCommentsByReportID($report->id);
        $compComments->updateViews($comments);
        return $this->controller->render('check_reports', [
            'user' => $reportUser,
            'tasks' => $userReportTasks,
            'date' => (new \DateTime($report->date))->format('d.m.Y'),
            'report' => $report,
            'reportsCount' => $reportsCount,
            'notifConfEmail' => $notifConfEmail,
            'comments' => $comments,
            'self' => $selfUser,
        ]);

    }

}