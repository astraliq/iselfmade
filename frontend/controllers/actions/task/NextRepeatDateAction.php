<?php


namespace frontend\controllers\actions\task;


use frontend\components\TasksComponent;
use frontend\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class NextRepeatDateAction  extends Action {
    public function run() {

        if (!\Yii::$app->request->isPost) {
            throw new HttpException(403,'Нет доступа');
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $id = \Yii::$app->request->post()['id'] ?? null;
        $user_id = \Yii::$app->request->post()['user_id'] ?? null;
        $action = $this->id;
        $task = $model->findOne(['id' => $id, 'user_id' => \Yii::$app->user->getId()]);

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

        $nextRepeatDate = $comp->getNextRepeatDate($task);
        if ($nextRepeatDate) {
            if (\Yii::$app->request->isAjax) {
                return ['result' => true, 'nextDate' => $nextRepeatDate];
            }
        } else {
            if (\Yii::$app->request->isAjax) {
                return ['result' => false];
            }
        }



        return $this->controller->redirect([\Yii::$app->params['links']['report']]);

    }

}