<?php


namespace app\controllers\actions\task;


use app\components\ReportCommentsComponent;
use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\ReportComments;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class FuruteAction extends Action {
    public function run() {

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canViewOwnTask()) {
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