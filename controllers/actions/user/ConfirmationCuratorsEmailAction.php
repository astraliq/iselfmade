<?php


namespace app\controllers\actions\user;


use app\components\UserComponent;
use app\models\User;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class ConfirmationCuratorsEmailAction extends Action {
    public function run($user=null,$confirmation_token=null){

        if ((!$user || !$confirmation_token) && !\Yii::$app->request->isPost) {
            throw new HttpException(400,'Отсутствуют необходимые параметры.');
        }

        $comp = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $model = $comp->getModel();

        $user = $model->findOne(['id' => $user]);
        if (!$user) {
            throw new HttpException(400,'Отсутствуют необходимые параметры.');
        }

        if ($comp->confirmCuratorsEmail($user, $confirmation_token)) {
            return $this->controller->redirect('/confirm-mentor-email?result=1');
        }

        return $this->controller->redirect('/confirm-mentor-email?result=0');
    }
}