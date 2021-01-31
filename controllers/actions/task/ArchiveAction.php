<?php


namespace app\controllers\actions\task;


use app\components\ReportCommentsComponent;
use app\components\ReportsComponent;
use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\ReportComments;
use app\models\Tasks;
use app\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class ArchiveAction extends Action {
    public function run($id=null) {
        $admin = false;

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $action = $this->id;

        $userId = \Yii::$app->user->getId();
        $yesterdayDate = date('d.m.Y', strtotime( "-1 day"));
        $yesterdayUTC = date('Y-m-d', strtotime( "-1 day"));
        $beforeYesterdayDate = date('d.m.Y', strtotime( "-2 day"));
        $yesterdayTasks = $comp->getTasksByDateAndUserId($userId, $yesterdayDate);
        $beforeYesterdayTasks = $comp->getTasksByDateAndUserId($userId, $beforeYesterdayDate);

        $compReports = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $modelReport = $compReports->getModel();
        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);


        $reportsModel = new UsersReports();
        $yesterdayMentorGrade = $reportsModel->findOne(['user_id' => $userId, 'date' => $yesterdayUTC])->mentor_grade;

        // архив задач за последний месяц
//        $date1 = date('d.m.Y', strtotime( "-1 month"));
//        $archiveTasks = $comp->getUserTasksBetweenTwoDates($userId, $date1, $yesterdayDate);

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $tasks;
        }

        $reports = $compReports->getLastReports(7);

        if ($id) {
            $report = $modelReport->findOne(['id' => $id]);
            $date = \Yii::$app->formatter->asDateTime($report->date, 'php:d.m.Y');
            $title = '';
        } else {
            $report = $compReports->getUserReportsByDatesArr($yesterdayUTC)[0];
            $date = $yesterdayDate;
            $title = 'Вчера';
        }

        $comments = $compComments->getReportCommentsByReportID($report->id);
        $tasksCountReports = $comp->getCountsTasksForReports($reports);
        $compComments->updateViews($comments);
        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('archive', [
//            'archiveTasks' => $archiveTasks,
            'yesterdayTasks' => $yesterdayTasks,
            'yesterdayDate' => $date,
            'beforeYesterday' => $beforeYesterdayTasks,
            'beforeYesterdayDate' => $beforeYesterdayDate,
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