<?php


namespace frontend\controllers\actions\task;

use frontend\components\ReportCommentsComponent;
use frontend\components\ReportsComponent;
use frontend\components\TasksComponent;
use frontend\components\widgets\reports\ArchiveReportWidget;
use frontend\models\ReportComments;
use frontend\models\Tasks;
use frontend\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class GetArchiveAction extends Action {
    public function run() {

        if (\Yii::$app->user->isGuest) {
            return $this->controller->redirect('/');
        }
        if (!\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        if (!\Yii::$app->request->isPost) {
            throw new HttpException(403, 'Нет доступа' );
        }
        \Yii::$app->response->format=Response::FORMAT_JSON;

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $compReports = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);


        $yesterdayDate = date('d.m.Y', strtotime( "-1 day"));
        $beforeYesterdayDate = date('d.m.Y', strtotime( "-2 day"));
        $today = date('d.m.Y');
        $unixToday = strtotime($today);
        $date = \Yii::$app->request->post()['date'] ?? null;
        $unixDate = strtotime($date);
        if ($unixDate >= $unixToday) {
            return ['result' => false, 'message' => 'Можно просмотреть задачи только за прошедший период.'];
        }
        $title = '';
        if ($date === $yesterdayDate) {
            $title = 'Вчера';
        } elseif ($date === $beforeYesterdayDate) {
            $title = 'Позавчера';
        }

        $dateUTC = (new \DateTime(date($date)))->format('Y-m-d');
        $archiveTasks = $comp->getArchiveTasksByDate($date, 1);
        $reportsModel = (new UsersReports())->findOne(['user_id' => \Yii::$app->user->getId(), 'date' => $dateUTC]);
        $mentorGrade = $reportsModel?->mentor_grade;

        $report = $compReports->getUserReportsByDatesArr($dateUTC)[0] ?? null;
        $comments = $compComments->getReportCommentsByReportID($report?->id);
        $compComments->updateViews($comments);

        if ($archiveTasks) {
            return [
                'result' => true,
                'html' => ArchiveReportWidget::widget([
                    'title' => $title,
                    'report' => $report,
                    'date' => $date,
                    'tasks' => $archiveTasks,
                    'grade' => $mentorGrade,
                    'self' => \Yii::$app->user->getIdentity(),
                    'comments' => $comments,
                ]),
                ];
        } else {
            return ['result' => false, 'message' => 'В выбранную дату задачи отсутствовали.'];
        }

    }
}