<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\models\Tasks;
use app\models\User;
use yii\base\Action;
use yii\bootstrap\ActiveForm;
use yii\web\HttpException;
use yii\web\Response;

class CreateAction extends Action {
    public $view;

    public function run() {

        if (!\Yii::$app->request->isPost || !\Yii::$app->rbac->canCreateTask()) {
            throw new HttpException(403,'Нет доступа');
        }
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $id = \Yii::$app->request->post()['id'] ?? null;
        $user_id = \Yii::$app->request->post()['user_id'] ?? null;
        $action = $this->id;

        if ($action == 'change') {
            $task = $model->findOne(['id' => $id, 'user_id' => \Yii::$app->user->getId()]);
            if (!$task) {
                throw new HttpException(404, 'Задача не найдена');
            }
            if (!\Yii::$app->user->can('updateOwnTasks', ['task' => $task])) {
                throw new HttpException(403,'Нет доступа');
            }
            \Yii::$app->rbac->canAccessCRUDTask($id, $task, $user_id);
        } elseif ($action == 'create') {
            if (!\Yii::$app->user->can('createTasks')) {
                throw new HttpException(403,'Вы не можете создать задачу');
            }
            $task = $model;
        }

        $task->load(\Yii::$app->request->post());

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }

        if ($comp->addTask($task)) {
            $newTask = $comp->getUserTask($task->id);
            if (\Yii::$app->request->isAjax) {
                if ($task->repeat_created == 1) {
                    $newTask->nextRepeatDate = $comp->getNextRepeatDate($newTask);
                }
                return ['result' => true, 'task' => \app\widgets\tasks\OneTaskViewWidget::widget([
                    'task' => $newTask,
                    'repeatedTask' => $task->repeat_created == 1 ? true : false,
                    'nextPeriod' => $task->nextPeriod,
                    'type_id' => 1,
                ])];
            }
        } else {
            if (\Yii::$app->request->isAjax) {
                return ['result' => false];
            }
        }

        return $this->controller->redirect([\Yii::$app->params['links']['report']]);

    }
}