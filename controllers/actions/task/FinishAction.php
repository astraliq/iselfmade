<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class FinishAction extends Action {
    public function run($id, $user_id=null) {

        if (\Yii::$app->user->isGuest) {
            throw new HttpException(403, 'Нет доступа');
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $task = $model->findOne(['id' => $id, 'user_id' => \Yii::$app->user->getId()]);
        $action = $this->id;

        if (!$task) {
            throw new HttpException(404, 'Задача не найдена');
        } else {
            if (!\Yii::$app->user->can('updateOwnTasks',['task' => $task])) {
                throw new HttpException(403,'Нет доступа');
            }
        }

        \Yii::$app->rbac->canAccessCRUDTask($id, $task, $user_id);

        if (!$comp->finishTask($task)) {
            return false;
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $task;
        }

        return $this->controller->redirect(['/report']);
    }
}