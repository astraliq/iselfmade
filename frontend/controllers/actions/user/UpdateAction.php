<?php


namespace frontend\controllers\actions\user;


use frontend\components\TimeZoneComponent;
use frontend\components\UserComponent;
use frontend\models\User;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class UpdateAction extends Action {
    public function run($id=null) {
        if (!\Yii::$app->rbac->updateAllUsersProfile() && $id) {
            throw new HttpException(403,'Нет доступа');
        }

        if (!\Yii::$app->rbac->canUpdateOwnProfile() || !\Yii::$app->rbac->canViewOwnProfile()) {
            throw new HttpException(403,'Нет доступа');
        }

        $admin = false;
        $comp = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $user = $comp->getModel();
        $userId = $id ?? \Yii::$app->user->getId();
        $user = $user->findOne(['id' => $userId]);

        if (!$user) {
            throw new HttpException(404, 'Страница не найдена');
        }

        if (!\Yii::$app->rbac->canViewUserProfile($user) && $id) {
            throw new HttpException(403,'Нет доступа');
        }

        if (\Yii::$app->request->isPost) {
            $postData = \Yii::$app->request->post();
            if ($postData['User']['password'] || $postData['User']['repeat_password']) {
                $user->scenarioUpdateWithPass();
            }
            $user->load($postData);

            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($user);
            }

            if ($comp->updateUser($user)) {
                if (\Yii::$app->request->isAjax) {

                    return ['result' => true, 'user' => $user];
                } else {
                    return $this->controller->redirect(['/profile']);
                }
            } else {
                if (\Yii::$app->request->isAjax) {
                    return ['result' => 'false'];
                } else {
                    goto render;
                }

            }
        }

        render:
        $timezones = \Yii::$app->timezones->getRuTimezones('short_gmt');

        $userComp = \Yii::createObject(['class' => UserComponent::class]);
        $notifConfEmail = $userComp->checkConfirmationEmail();

        return $this->controller->render('view',[
            'user' => $user,
            'timezones' => $timezones,
            'admin' => $admin,
            'notifConfEmail' => $notifConfEmail,
        ]);
    }


}