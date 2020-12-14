<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class ArchiveAction extends Action {
    public function run() {
        $admin = false;

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $action = $this->id;

        $userId = \Yii::$app->user->getId();
        $yesterdayDate = date('d.m.Y', strtotime( "-1 day"));
        $beforeYesterdayDate = date('d.m.Y', strtotime( "-2 day"));
        $yesterdayTasks = $comp->getTasksByDateAndUserId($userId, $yesterdayDate);
        $beforeYesterdayTasks = $comp->getTasksByDateAndUserId($userId, $beforeYesterdayDate);


        // архив задач за последний месяц
//        $date1 = date('d.m.Y', strtotime( "-1 month"));
//        $archiveTasks = $comp->getUserTasksBetweenTwoDates($userId, $date1, $yesterdayDate);

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $tasks;
        }

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('archive', [
//            'archiveTasks' => $archiveTasks,
            'yesterday' => $yesterdayTasks,
            'yesterdayDate' => $yesterdayDate,
            'beforeYesterday' => $beforeYesterdayTasks,
            'beforeYesterdayDate' => $beforeYesterdayDate,
            'admin'=>$admin,
            'notifConfEmail' => $notifConfEmail,
        ]);

    }
}