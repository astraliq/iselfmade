<?php


namespace frontend\controllers\actions\task;


use frontend\components\ReportCommentsComponent;
use frontend\components\ReportsComponent;
use frontend\components\TasksComponent;
use frontend\components\UserComponent;
use frontend\models\ReportComments;
use frontend\models\Tasks;
use frontend\models\TasksSearch;
use frontend\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class ViewAllTasks extends Action {

    public function run() {

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);

        // задачи на сегодня
        $tasks = $comp->getTodayUserTasks();

        // задачи на завтра
        $tasksTomorrow = $comp->getTomorrowUserTasks();
        // задачи на месяц
        $aims = $comp->getTodayUserAims();
        // задачи на год
        $goals = $comp->getTodayUserGoals();
        // удаленные задачи
//        $deleted = $comp->getDeletedTasks();

//        $checkRenewTasks = $comp->checkDataToRenew(1);
//        $checkRenewAims = $comp->checkDataToRenew(2);
//        $checkRenewGoals = $comp->checkDataToRenew(3);

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $tasks;
        }

        $userId = \Yii::$app->user->getId();
        $self = \Yii::$app->user->getIdentity();

        $compReports = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $report = $compReports->getModel();
        $userReport = $report->findOne(['user_id' => \Yii::$app->user->getId(), 'date' => date('Y-m-d')]);

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        if ($userReport) {
            $comments = $compComments->getReportCommentsByReportID($userReport->id);
        } else {
            $comments = null;
        }

        return $this->controller->render('view_all', [
            'tasks' => $tasks,
            'tasksTomorrow' => $tasksTomorrow,
            'aims' => $aims,
            'goals' => $goals,
//            'renewTasks' => $checkRenewTasks,
//            'renewAims' => $checkRenewAims,
//            'renewGoals' => $checkRenewGoals,
            'model' => $model,
            'userReport' => $userReport,
            'userId' => $userId,
            'self' => $self,
            'notifConfEmail' => $notifConfEmail,
            'comments' => $comments,
        ]);

    }
}