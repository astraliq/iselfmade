<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;

class PromisesAction extends Action {
    public function run() {

        if (\Yii::$app->user->isGuest) {
            return $this->controller->redirect('/');
        }
        if (!\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('promises', [
            'futureTasks' => '',
            'notifConfEmail' => $notifConfEmail,
        ]);
    }
}