<?php


namespace frontend\controllers\actions\task;


use frontend\components\TasksComponent;
use frontend\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class DeleteAction extends Action {
    public function run() {

        if (!\Yii::$app->request->isPost) {
            throw new HttpException(403,'Нет доступа');
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $id = \Yii::$app->request->post()['id'] ?? null;
        $user_id = \Yii::$app->request->post()['user_id'] ?? null;
        $task = $model->findOne(['id' => $id, 'user_id' => \Yii::$app->user->getId()]);
        $action = $this->id;

        if (!$task) {
            throw new HttpException(404, 'Задача не найдена');
        } else {
            if (!\Yii::$app->user->can('deleteOwnTasks',['task' => $task])) {
                throw new HttpException(403,'Нет доступа');
            }
        }

        \Yii::$app->rbac->canAccessCRUDTask($id, $task, $user_id);

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
        }

        if ($task->deleted == 0 && $action === 'del') {
            if (!$comp->deleteTask($task)) {
                return ['result' => false];
            } else {
                return ['result' => true];
            }
        }

        if ($task->deleted == 1 && $action === 'restore') {
            if (!$comp->restoreTask($task)) {
                return ['result' => false];
            } else {
                return ['result' => true];
            }
        }

        if ($action === 'hard-del') {
            if ($task->deleted == 1) {
                if (!$comp->hardDeleteTask($task)) {
                    return ['result' => false];
                } else {
                    return ['result' => true];
                }
            } else {
                throw new HttpException(403,'Задача еще не удалена');
            }
        }

        return $this->controller->redirect([\Yii::$app->params['links']['report']]);
    }
}