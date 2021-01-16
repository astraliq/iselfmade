<?php


namespace app\controllers\actions\report;


use app\components\ReportsComponent;
use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\Tasks;
use app\models\User;
use app\models\UsersReports;
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

        $userId = \Yii::$app->request->post()['user_id'] ?? null;
        $date = \Yii::$app->request->post()['date'] ?? null;
        $status = \Yii::$app->request->post()['status'] ?? null;

        if (!$userId || !$date) {
            return ['result' => false];
        }

        $change = $comp->changeReportStatus($userId, $date, $status);
        $nextReport = $comp->getFirstUserReport();
        $reportUser = $modelUsers->findOne(['id' => $nextReport->user_id]);
        $userReportTasks = $compTasks->getTasksByDateAndUserId($reportUser->id, $nextReport->date);
        $reportsCount = $comp->getCountReportsToCheck() - 1;

        if ($change) {
            return [
                'result' => true,
                'nextReport' => CheckReportsWidget::widget([
                    'user' => $reportUser,
                    'tasks' => $userReportTasks,
                    'block_id' => 0,
                    'date' => (new \DateTime($nextReport->date))->format('d.m.Y'),
                ]),
                'reportsCount' => $reportsCount,
            ];
        } else {
            return ['result' => false];
        }

    }

}