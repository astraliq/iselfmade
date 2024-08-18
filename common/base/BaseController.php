<?php


namespace common\base;

use frontend\components\NotificationsComponent;
use yii\filters\HostControl;
use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{
    public $previousUrl = '/';

    public function beforeAction($action) {

        $user = \Yii::$app->user->getIdentity();
        if ($user) {
            \Yii::$app->setTimeZone(\Yii::$app->user->getIdentity()->getTimezone());
        }

        header("Host: " . \Yii::$app->params['host']);
        \Yii::$app->getUrlManager()->setHostInfo(\Yii::$app->params['hostInfo']);
        \Yii::$app->getRequest()->setHostInfo(\Yii::$app->params['hostInfo']);


        if (!\Yii::$app->user->isGuest) {
            $compNotifs = \Yii::createObject(['class' => NotificationsComponent::class]);
            $this->view->params['notifs'] = $compNotifs->getAllNotifications();
        }
        $this->view->params['user'] = \Yii::$app->user->getIdentity();

        return parent::beforeAction($action);
    }
    public function afterAction($action, $result)
    {

        return parent::afterAction($action, $result); // TODO: Change the autogenerated stub
    }
}