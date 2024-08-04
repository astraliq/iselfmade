<?php


namespace frontend\controllers\actions\task;


use frontend\components\ReportCommentsComponent;
use frontend\components\ReportsComponent;
use frontend\components\TasksComponent;
use frontend\components\UserComponent;
use frontend\models\ReportComments;
use frontend\models\Tasks;
use frontend\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ArchiveAction extends Action {
    public function run($id=null) {

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $action = $this->id;

        $userId = \Yii::$app->user->getId();
        $yesterdayDate = date('d.m.Y', strtotime( "-1 day"));
        $yesterdayUTC = date('Y-m-d', strtotime( "-1 day"));
        $beforeYesterdayDate = date('d.m.Y', strtotime( "-2 day"));


        $compReports = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $modelReport = $compReports->getModel();
        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);


        $reportsModel = UsersReports::findOne(['user_id' => $userId, 'date' => $yesterdayUTC]);
        $yesterdayMentorGrade = $reportsModel?->mentor_grade;

        // архив задач за последний месяц
//        $date1 = date('d.m.Y', strtotime( "-1 month"));
//        $archiveTasks = $comp->getUserTasksBetweenTwoDates($userId, $date1, $yesterdayDate);

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            if ($id) {
                return $modelReport->findOne(['id' => $id]);
            } else {
                return false;
            }
        }

//        $beforeYesterdayTasks = $comp->getTasksByDateAndUserId($userId, $beforeYesterdayDate);

        if ($id) {
            $report = $modelReport->findOne(['id' => $id]);
            if ($report) {
                if (\Yii::$app->rbac->canViewReport($report)) {
                    $date = \Yii::$app->formatter->asDateTime($report->date, 'php:d.m.Y');
                    $title = '';
                    $yesterdayTasks = $comp->getArchiveTasksByDate($date, 1);
                } else {
                    goto def;
                }
            } else {
                goto def;
            }
        } else {
            def:
            $yesterdayTasks = $comp->getArchiveTasksByDate($yesterdayDate, 1);
            $report = $compReports->getUserReportsByDatesArr($yesterdayUTC)[0] ?? null;
            $date = $yesterdayDate;
            $title = 'Вчера';
        }

        $reports = $compReports->getLastReports(7);
        $comments = $compComments->getReportCommentsByReportID($report?->id);
        $tasksCountReports = $comp->getCountsTasksForReports($reports);
        $compComments->updateViews($comments);
        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('archive', [
//            'archiveTasks' => $archiveTasks,
            'yesterdayTasks' => $yesterdayTasks,
            'yesterdayDate' => $date,
//            'beforeYesterday' => $beforeYesterdayTasks,
//            'beforeYesterdayDate' => $beforeYesterdayDate,
            'yesterdayGrade' => $yesterdayMentorGrade,
            'reports' => $reports,
            'yesterdayReport' => $report,
            'comments' => $comments,
            'tasksCountReports' => $tasksCountReports,
            'self' => \Yii::$app->user->getIdentity(),
            'notifConfEmail' => $notifConfEmail,
            'title' => $title,
        ]);

    }
}