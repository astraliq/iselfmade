<?php


namespace frontend\controllers;

use common\base\BaseController;
use frontend\components\UserComponent;
use frontend\controllers\actions\site\ErrorAction;
use frontend\models\User;
use yii\db\Exception;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AuthController extends BaseController {

    public $layout = 'main';
    private $auth;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->auth = \Yii::$app->auth;
    }

    public function actions() {
        return [
            'error' => ['class' => ErrorAction::class],
        ];
    }

    // регистрация
    public function actionSignUp(){

        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->getIdentity();
            if ($user->welcome_view == 0) {
                return $this->redirect(['/welcome']);
            } else {
                return $this->redirect(['/report']);
            }
        }

        $model = new User([
            'scenario' => 'signUp'
        ]);

        if (\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            $transaction = \Yii::$app->db->beginTransaction();
            if ($this->auth->signUp($model)) {
                try {
                    $this->auth->sendConfirmationMail($model);
                    $transaction->commit();
                    if ($this->auth->signIn($model)) {
                        return $this->redirect(['/welcome']);
                    }
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw new HttpException(500,'Произошла внутренняя ошибка сервера');
                }
            }
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        $this->view->params['model'] = $model;
        return $this->redirect(['/']);
    }

    // авторизация
    public function actionSignIn(){

        \Yii::$app->request->setHostInfo(Url::toRoute('/'));

        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->getIdentity();
            if ($user->welcome_view == 0) {
                return $this->redirect(['/welcome']);
            } else {
                return $this->redirect(['/report']);
            }
        }

        $model = new User([
            'scenario' => 'signIn'
        ]);

        if (\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if ($this->auth->signIn($model)) {

                return $this->redirect(['/report']);
            } else {
                if (\Yii::$app->request->isAjax) {
                    \Yii::$app->response->format = Response::FORMAT_JSON;

                    return ActiveForm::validate($model);
                }
            }
        }

        $this->view->params['model'] = $model;
        return $this->redirect(['/']);
    }

    // восстановление пароля
    public function actionRemindPassword(){

        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->getIdentity();
            if ($user->welcome_view == 0) {
                return $this->redirect(['/welcome']);
            } else {
                return $this->redirect(['/report']);
            }
        }

        $model = new User([
            'scenario' => 'remindPass'
        ]);
        if (\Yii::$app->request->isPost) {
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
            }
            $model->load(\Yii::$app->request->post());
            $validate = $model->validate();
            if ($validate) {
                if ($this->auth->sendRecoveryPassEmail($model)) {
                    \Yii::$app->session->set('user_email', $model->email);

                    return ['result' => true];
                } else {
                    return ['result' => false];
                }
            } else {
                return ActiveForm::validate($model);
            }
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ['result' => false];
        } else {
            $this->view->params['model'] = $model;
            return $this->redirect(['/']);
        }

    }

    // валидация для восстановления пароля
    public function actionValidateRemindPassword(){

        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->getIdentity();
            if ($user->welcome_view == 0) {
                return $this->redirect(['/welcome']);
            } else {
                return $this->redirect(['/report']);
            }
        }
        $model = new User([
            'scenario' => 'remindPass'
        ]);
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $validate = $model->validate();
            if ($validate) {
                return ['result' => true];
            } else {
                return ActiveForm::validate($model);
            }
        }
        if (\Yii::$app->request->isAjax) {
            return ['result' => false];
        } else {
            $this->view->params['model'] = $model;
            return $this->redirect(['/']);
        }
    }

    // изменение пароля
    public function actionRestorePassword($email=null, $token=null){
        $this->layout = 'error_base';
        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->getIdentity();
            if ($user->welcome_view == 0) {
                return $this->redirect(['/welcome']);
            } else {
                return $this->redirect(['/report']);
            }
        }
        $model = new User([
            'scenario' => 'restorePass'
        ]);
        if (!$email) {
            if (\Yii::$app->session->get('user_email')) {
                $email = \Yii::$app->session->get('user_email');
            }
        }
        if (\Yii::$app->request->isPost && \Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $model->load(\Yii::$app->request->post());
            $validate = $model->validate();
            if ($validate) {
                if ($this->auth->updatePassword($model)) {
                    $model->scenario = 'signIn';
                    $this->auth->signIn($model);
                    return $this->redirect([\Yii::$app->params['links']['report']]);
                } else {
                    return ['result' => false];
                }
            } else {
                return ActiveForm::validate($model);
            }
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ['result' => false];
        } else {
            $modelSignIn = new User([
                'scenario' => 'signIn'
            ]);
            $modelSignUp = new User([
                'scenario' => 'signUp'
            ]);
            $restoreModel = new User([
                'scenario' => 'restorePass'
            ]);

            $model->token = $token;
            $this->view->params['signIn'] = $modelSignIn;
            $this->view->params['signUp'] = $modelSignUp;
            $this->view->params['restoreModel'] = $restoreModel;
            $this->view->params['model'] = $model;

            return $this->render('restore_password',[
                'model' => $model,
                'email' => $email,
                'token' => $token,
            ]);
        }

    }

    // Подтверждение почты
    public function actionConfirmationEmail($email=null, $confirmation_token=null){

        if ((!$email || !$confirmation_token) && !\Yii::$app->request->isPost) {
            throw new HttpException(400,'Отсутствуют необходимые параметры');
        }

        $model = new User([
            'scenario' => 'confirmationEmail'
        ]);
        $model->email = $email;
        $model->confirmation_token = $confirmation_token;

        if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $model = \Yii::$app->user->getIdentity();
        }

        $validate = $model->validate();
        if ($validate) {
            if ($this->auth->confirmEmail($model)) {
                if (\Yii::$app->request->isAjax) {
                    return ['result' => true];
                }
                return $this->redirect([\Yii::$app->params['links']['report']]);
            }
        }

        if (\Yii::$app->request->isAjax) {
            return ['result' => false];
        }

        return $this->redirect('/');
    }

    // Запрос на отправку письма на почту с подтверждение адреса почты пользователя
    public function actionSendConfirmationEmail(){
        if (\Yii::$app->user->isGuest || !\Yii::$app->request->isPost) {
            throw new HttpException(403,'нет доступа');
        }
        $model = new User([
            'scenario' => 'confirmationEmail'
        ]);
        if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $model = \Yii::$app->user->getIdentity();
        }
        $validate = $model->validate();
        if ($validate) {
            if ($this->auth->sendConfirmationMail($model)) {
                return ['result' => true];
            }
        }
        return ['result' => false];
    }

    // валидация пользователя для авторизации
    public function actionValidateSignIn(){
        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->getIdentity();
            if ($user->welcome_view == 0) {
                return $this->redirect(['/welcome']);
            } else {
                return $this->redirect(['/report']);
            }
        }

        $model = new User([
            'scenario' => 'signIn'
        ]);

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }

        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
            return ActiveForm::validate($model);
        }

        throw new HttpException(401, 'Ошибка входа');
    }
}