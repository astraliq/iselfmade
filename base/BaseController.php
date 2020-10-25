<?php


namespace app\base;

use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{
    public $previousUrl = '/';

    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        \Yii::$app->setTimeZone(\Yii::$app->user->getIdentity()->getTimezone());
//        if (!\Yii::$app->request->isPost) {
//            \Yii::$app->session->addFlash('lastPage',\Yii::$app->request->referrer);
//        }

        return parent::beforeAction($action);
    }
    public function afterAction($action, $result)
    {

        return parent::afterAction($action, $result); // TODO: Change the autogenerated stub
    }
}