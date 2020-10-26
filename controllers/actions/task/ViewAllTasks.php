<?php


namespace app\controllers\actions\task;


use app\Components\TasksComponent;
use app\models\Tasks;
use app\models\TasksSearch;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class ViewAllTasks extends Action {
    public function run() {
        $admin = false;

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canViewOwnTask()) {
//            throw new HttpException(404, 'Нет доступа');
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

        $checkRenewTasks = $comp->checkDataToRenew(1);
        $checkRenewAims = $comp->checkDataToRenew(2);
        $checkRenewGoals = $comp->checkDataToRenew(3);

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $tasks;
        }

        return $this->controller->render('view_all', [
            'tasks' => $tasks,
            'tasksTomorrow' => $tasksTomorrow,
            'aims' => $aims,
            'goals' => $goals,
//            'deleted' => $deleted,
            'renewTasks' => $checkRenewTasks,
            'renewAims' => $checkRenewAims,
            'renewGoals' => $checkRenewGoals,
            'model' => $model,
//            'provider' => $provider,
            'admin'=>$admin,
        ]);

    }
}