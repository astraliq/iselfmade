<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class CheckReportsAction extends Action {
    public function run() {
        $admin = false;

        if (\Yii::$app->user->isGuest || !\Yii::$app->user->can('moderator')) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $action = $this->id;

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

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('check_reports', [
            'tasks' => $tasks,
            'tasksTomorrow' => $tasksTomorrow,
            'aims' => $aims,
            'goals' => $goals,
//            'renewTasks' => $checkRenewTasks,
//            'renewAims' => $checkRenewAims,
//            'renewGoals' => $checkRenewGoals,
            'model' => $model,
            'admin'=>$admin,
            'notifConfEmail' => $notifConfEmail,
        ]);

    }
}