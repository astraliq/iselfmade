<?php


namespace app\controllers;

use app\models\User;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AuthController extends Controller
{
    private $auth;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->auth = \Yii::$app->auth;
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
                \Yii::$app->session->addFlash('user_email',$model->email);
                return $this->redirect(['/auth/sign-in']);
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