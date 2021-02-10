<?php


namespace app\controllers\actions\task;


use app\components\ReportCommentsComponent;
use app\components\ReportsComponent;
use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\ReportComments;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class GoalsAction extends Action {
    public function run() {

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);

        // задачи на месяц
        $aims = $comp->getTodayUserAims();
        // задачи на год
        $goals = $comp->getTodayUserGoals();

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $tasks;
        }

        $userId = \Yii::$app->user->getId();
        $self = \Yii::$app->user->getIdentity();

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('goals', [
            'aims' => $aims,
            'goals' => $goals,
            'model' => $model,
            'userId' => $userId,
            'notifConfEmail' => $notifConfEmail,
        ]);
    }
}