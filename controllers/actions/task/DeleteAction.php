<?php


namespace app\controllers\actions\task;


use app\Components\TasksComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class DeleteAction extends Action {
    public function run($id, $user_id=null) {

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
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

        if ($task->deleted == 0 && $action === 'del') {
            if (!$comp->deleteTask($task)) {
//                echo '<pre>';
//                echo print_r($task->getErrors());
//                echo '<pre>';
                return false;
            }
        }

        if ($task->deleted == 1 && $action === 'restore') {
            if (!$comp->restoreTask($task)) {
                return false;
            }
        }

        if ($action === 'hard-del') {
            if ($task->deleted == 1) {
                if (!$comp->hardDeleteTask($task)) {
                    return false;
                }
            } else {
                throw new HttpException(403,'Задача еще не удалена');
            }
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $task;
        }

        return $this->controller->redirect(['/report']);
    }
}