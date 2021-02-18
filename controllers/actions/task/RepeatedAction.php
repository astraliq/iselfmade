<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class RepeatedAction extends Action {
    public function run() {

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $repeatedTasks = $comp->getAllRepeatedTasks();

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $repeatedTasks;
        }

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('repeated',[
            'repeatedTasks' => $repeatedTasks,
            'admin' => $admin,
            'notifConfEmail' => $notifConfEmail,
        ]);
    }
}