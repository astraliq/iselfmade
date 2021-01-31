<?php


namespace app\controllers\actions\report;


use app\components\ReportCommentsComponent;
use app\components\ReportsComponent;
use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\ReportComments;
use app\models\Tasks;
use app\models\User;
use app\models\UsersReports;
use app\widgets\comments\CommentsWidget;
use app\widgets\tasks\CheckReportsWidget;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class ChangeReportStatusAction extends Action {
    public function run() {
        if (\Yii::$app->user->isGuest || !\Yii::$app->user->can('curator')) {
            throw new HttpException(403, 'Нет доступа' );
        }
        if (!\Yii::$app->request->isPost) {
            throw new HttpException(403,'Нет доступа');
        }
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }
        $comp = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $model = $comp->getModel();
        $compTasks = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $modelTasks = $compTasks->getModel();
        $compUsers = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $modelUsers = $compUsers->getModel();
        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);

        $userId = \Yii::$app->request->post()['user_id'] ?? null;
        $date = \Yii::$app->request->post()['date'] ?? null;
        $status = \Yii::$app->request->post()['status'] ?? null;

        if (!$userId || !$date) {
            return ['result' => false];
        }

        $change = $comp->changeReportStatus($userId, $date, $status);

        if ($change) {
            $nextReport = $comp->getFirstUserReport();
            $reportUser = $modelUsers->findOne(['id' => $nextReport->user_id]);
            $userReportTasks = $compTasks->getTasksByDateAndUserId($reportUser->id, $nextReport->date);
            $reportsCount = $comp->getCountReportsToCheck() - 1;
            $comments = $compComments->getReportCommentsByReportID($nextReport->id);
            $compComments->updateViews($comments);
            return [
                'result' => true,
                'nextReport' => CheckReportsWidget::widget([
                    'user' => $reportUser,
                    'tasks' => $userReportTasks,
                    'block_id' => 0,
                    'date' => (new \DateTime($nextReport->date))->format('d.m.Y'),
                    'userReport' => $nextReport,
                ]),
                'reportsCount' => $reportsCount,
                'comments' => CommentsWidget::widget([
                    'comments' => $comments,
                    'self' => \Yii::$app->user->getIdentity(),
                    'report' => $nextReport,
                ]),
            ];
        } else {
            return ['result' => false];
        }

    }

}