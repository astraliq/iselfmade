<?php


namespace frontend\controllers\actions\task;


use frontend\components\TasksComponent;
use frontend\components\UserComponent;
use frontend\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;

class PossibleAction extends Action {
    public function run() {

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('possible', [
            'futureTasks' => '',
            'notifConfEmail' => $notifConfEmail,
        ]);
    }
}