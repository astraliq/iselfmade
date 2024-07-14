<?php


namespace frontend\controllers\actions\task;


use frontend\components\ReportsComponent;
use frontend\components\TasksComponent;
use frontend\components\UserComponent;
use frontend\models\Tasks;
use frontend\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class WelcomeAction extends Action {
    public function run() {

        $user = \Yii::$app->user->getIdentity();

        if ($user->welcome_view == 1) {
            return $this->controller->redirect(['/report']);
        }

        $user->welcome_view = 1;
        $user->save(false);


        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        // задачи на месяц
        $aims = $comp->getTodayUserAims();
        // задачи на год
        $goals = $comp->getTodayUserGoals();

        return $this->controller->render('welcome', [
//            'renewGoals' => $checkRenewGoals,
            'aims' => $aims,
            'goals' => $goals,
        ]);
    }

}