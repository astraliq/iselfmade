<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\components\UserComponent;
use app\models\Tasks;
use app\models\User;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class SetGradeAction extends Action {
    public function run($user, $date1, $date2, $period, $grade, $token) {

        if (!$token) {
            throw new HttpException(403,'Не указан токен пользователя.');
        }

        $tasksComp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $userComp = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $userModel = $userComp->getModel();

        $user = $userModel->findOne(['id' => $user]);
        if ($user->grade_token !== $token) {
            throw new HttpException(403,'Неверный токен пользователя.');
        }

        $setGrades = $tasksComp->setUserGrades($user->id, $period, $date1, $date2, $grade);

       if ($setGrades) {
           return $this->controller->redirect('/grade-result?result=1');
       } else {
           return $this->controller->redirect('/grade-result?result=0');
       }
    }

}