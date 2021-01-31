<?php

namespace app\controllers;

use app\components\DAOComponent;
use app\components\TimeZoneComponent;
use app\controllers\actions\site\ConfirmCuratorEmailAction;
use app\controllers\actions\site\ErrorAction;
use app\controllers\actions\site\GetNotifsAction;
use app\controllers\actions\site\GradeResultAction;
use app\controllers\actions\site\UpdateDataAction;
use app\models\RegistrationForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {

        return [
            'error' => ['class' => ErrorAction::class],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'confirm-curator-email' => ['class' => ConfirmCuratorEmailAction::class],
            'grade-result' => ['class' => GradeResultAction::class, ],
            'update-data' => ['class' => UpdateDataAction::class, ],
            'get-notifs' => ['class' => GetNotifsAction::class, ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {

        if (!\Yii::$app->user->isGuest) {
            $this->redirect('/report');
        }

        $modelSignIn = new User([
            'scenario' => 'signIn'
        ]);
        $modelSignUp = new User([
            'scenario' => 'signUp'
        ]);
        $restoreModel = new User([
            'scenario' => 'restorePass'
        ]);
        $this->view->params['signIn'] = $modelSignIn;
        $this->view->params['signUp'] = $modelSignUp;
        $this->view->params['restoreModel'] = $restoreModel;

//        if (!empty(\Yii::$app->session->getFlash('user_errors'))) {
//            $model->errors = \Yii::$app->session->getFlash('user_errors')[0];
//        }
        return $this->render('index');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionTasks() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionTest() {
        $userId = \Yii::$app->user->getId();
        $data = \Yii::$app->dao->getUserTasks($userId);

        return $this->render('test', [
            'test' => $data,
        ]);
    }

}
