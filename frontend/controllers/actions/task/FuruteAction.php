<?php


namespace frontend\controllers\actions\task;


use frontend\components\ReportCommentsComponent;
use frontend\components\TasksComponent;
use frontend\components\UserComponent;
use frontend\models\ReportComments;
use frontend\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class FuruteAction extends Action {
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

        return $this->controller->render('future', [
            'futureTasks' => '',
            'notifConfEmail' => $notifConfEmail,
        ]);
    }
}