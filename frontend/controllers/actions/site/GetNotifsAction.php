<?php


namespace frontend\controllers\actions\site;


use frontend\components\NotificationsComponent;
use frontend\components\ReportCommentsComponent;
use frontend\models\ReportComments;
use frontend\widgets\notification\NotificationsWidget;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\web\HttpException;
use yii\web\Response;

class GetNotifsAction extends Action {
    /**
     * @throws \Throwable
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function run() {
        if (\Yii::$app->user->isGuest) {
            throw new HttpException(403, 'Доступ запрещен!');
        }
        if (!\Yii::$app->request->isGet && !\Yii::$app->request->isAjax) {
            throw new HttpException(400, 'Некорректный запрос');
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $compNotifs = \Yii::createObject(['class' => NotificationsComponent::class]);
        $notifs = $compNotifs->getAllNotifications();

        if ($notifs) {
            return [
                'result' => true,
                'html' => NotificationsWidget::widget([
                    'notifs' => $notifs,
                ]),
            ];
        }

        return [
            'result' => false,
            'html' => NotificationsWidget::widget([
                'notifs' => $notifs,
            ]),
        ];
    }
}