<?php


namespace app\controllers\actions\user;


use app\Components\UserComponent;
use app\models\User;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class ViewAction extends Action {
    public function run($id=null) {

        if (!\Yii::$app->rbac->canViewOwnProfile()) {
            throw new HttpException(403,'Нет доступа');
        }

        $admin = false;
        $comp = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $model = $comp->getModel();
        $userId = $id ?? \Yii::$app->user->getId();
        $user = $model->findOne(['id' => $userId]);

        if (!$user) {
            throw new HttpException(404, 'Страница не найдена');
        }

        if (!\Yii::$app->rbac->canViewUserProfile($user) && $id) {
            throw new HttpException(403,'Нет доступа');
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format=Response::FORMAT_JSON;
            return $model;
        }

        return $this->controller->render('view',[
            'user' => $user,
            'admin' => $admin,
        ]);
    }
}