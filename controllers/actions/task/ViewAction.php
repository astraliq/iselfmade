<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class ViewAction extends Action {

    public function run() {

        return $this->controller->redirect([\Yii::$app->params['links']['report']]);

        $admin = false;
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $task = $model->findOne(['id' => $id, 'user_id' => \Yii::$app->user->getId()]);
        if (!$task) {
            throw new HttpException(404, 'Задача не найдена');
        }

        $tasks = $comp->getAllTasksArr();
        $aims = $comp->getAllAimsArr();
        $goals = $comp->getAllGoalsArr();
        if ($task->type_id != 1) {
            $childTasks = $comp->getChildTasks($task->id, $task->type_id);
        }

        \Yii::$app->rbac->canAccessCRUDTask($id, $task, $user_id);


        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $model;
        }



        return $this->controller->render('view',[
            'task' => $task,
            'tasks' => $tasks,
            'aims' => $aims,
            'childTasks' => $childTasks,
            'goals' => $goals,
            'admin' => $admin,
        ]);
    }
}