<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class FinishAction extends Action {
    public function run() {

        if (!\Yii::$app->request->isPost) {
            throw new HttpException(403,'Нет доступа');
        }
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $id = \Yii::$app->request->post()['id'] ?? null;
        $user_id = \Yii::$app->request->post()['user_id'] ?? null;
        $nextPeriod = \Yii::$app->request->post()['nextPeriod'] ?? null;
        $action = $this->id;
        $task = $model->findOne(['id' => $id, 'user_id' => \Yii::$app->user->getId()]);
        $task->nextPeriod = $nextPeriod;

        if (!$task) {
            throw new HttpException(404, 'Задача не найдена');
        } else {
            if (!\Yii::$app->user->can('updateOwnTasks',['task' => $task])) {
                throw new HttpException(403,'Нет доступа');
            }
        }

        \Yii::$app->rbac->canAccessCRUDTask($id, $task, $user_id);

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }

        if ($comp->finishTask($task)) {
            if (\Yii::$app->request->isAjax) {
                return ['result' => true];
            }
        } else {
            if (\Yii::$app->request->isAjax) {
                ['result' => false];
            }
        }

        return $this->controller->redirect([\Yii::$app->params['links']['report']]);
    }
}