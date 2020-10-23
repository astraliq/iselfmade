<?php


namespace app\controllers\actions\user;


use app\Components\TimeZoneComponent;
use app\Components\UserComponent;
use app\models\User;
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

//                    echo '<pre>';
//        print_r(\Yii::$app->request->post());
//        print_r($user);
//        echo '</pre>';
//        exit();
//            $data = \Yii::$app->request->post();
//            \Yii::$app->response->format = Response::FORMAT_JSON;
//            return $data;
//            exit();

            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($user);
            }

            if ($comp->updateUser($user)) {
//                $lastPage = \Yii::$app->session->getFlash('lastPage');
//                return $this->controller->redirect($lastPage);
//                return $this->controller->redirect(['/task/view/' . $user->id]);
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
//                echo '<pre>';
//                print_r($timezones);
//                echo '</pre>';
//                exit();

        return $this->controller->render('view',[
            'user' => $user,
            'timezones' => $timezones,
            'admin' => $admin,
        ]);
    }


}