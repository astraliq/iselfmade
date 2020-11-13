<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class UpdateAllAction extends Action {
    public $view;

    public function run() {
        if (\Yii::$app->user->isGuest ) {
            $this->controller->redirect(['/']);
        }
        if (!\Yii::$app->request->isPost || !\Yii::$app->rbac->canCreateTask()) {
            throw new HttpException(403,'Нет доступа');
        }
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $action = $this->id;

        $tasks = \Yii::$app->request->post()['Tasks'];

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }

        if ($comp->updateAllTasks($tasks)) {
            if (\Yii::$app->request->isAjax) {
                return ['result' => true];
            }
        } else {
            if (\Yii::$app->request->isAjax) {
                return ['result' => false];
            }
        }


        return $this->controller->redirect([\Yii::$app->params['links']['report']]);
    }
}