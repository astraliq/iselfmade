<?php


namespace app\controllers\actions\user;


use app\components\UserComponent;
use app\models\User;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class CuratorsEmailConfirmAction extends Action {
    public function run() {
        if (!\Yii::$app->rbac->updateAllUsersProfile() && $id) {
            throw new HttpException(403,'Нет доступа');
        }

        $comp = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $user = $comp->getModel();
        $userId = \Yii::$app->user->getId();
        $user = $user->findOne(['id' => $userId]);

        if (!$user) {
            throw new HttpException(404, 'Пользователь не найден');
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if (\Yii::$app->request->isPost) {
            $postData = \Yii::$app->request->post();
            if ($postData['User']['curators_emails']) {
                $user->curators_emails = $postData['User']['curators_emails'];

                if ($comp->updateUser($user)) {
                    if ($comp->sendConfirmCuratorEmailMail($user)) {
                        return ['result' => true];
                    } else {
                        return ['result' => 'false'];
                    }
                } else {
                    return ActiveForm::validate($user);
                }
            }
        }

        return ['result' => 'false'];
    }
}