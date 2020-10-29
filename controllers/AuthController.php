<?php


namespace app\controllers;

use app\controllers\actions\site\ErrorAction;
use app\models\User;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AuthController extends Controller {

    public $layout = 'main_page';
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

    public function actionSignUp(){

        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/report']);
        }

        $model = new User([
            'scenario' => 'signUp'
        ]);

        if (\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if ($this->auth->signUp($model)) {
                if ($this->auth->signIn($model)) {
                    return $this->redirect(['/profile']);
                }
            }
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        $this->view->params['model'] = $model;
        return $this->redirect(['/']);
//        return ActiveForm::validate($model);
//        return $this->render('signup',['model'=>$model]);
    }

    public function actionSignIn(){

        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/report']);
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


//        return ActiveForm::validate($model);
//        $this->render('//site/index');
//        return $this->render('signin',['model'=>$model]);
    }

    public function actionRemindPassword(){

        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/report']);
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
                if ($this->auth->sendRecoveryPassEmail($model->email)) {
                    return ['result' => true];
                } else {
                    return ['result' => false];
                }
            }
                return $validate;
        }

        $this->view->params['model'] = $model;
        return $this->redirect(['/']);
    }

    public function actionValidateSignIn(){
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/report']);
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