<?php


namespace frontend\controllers\actions\site;


use frontend\components\ReportCommentsComponent;
use frontend\models\ReportComments;
use frontend\models\User;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\web\HttpException;
use yii\web\Response;

class UpdateDataAction extends Action {
    /**
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function run() {
        if (\Yii::$app->user->isGuest) {
            throw new HttpException(400, 'Некорректный запрос');
        }
        if (!\Yii::$app->request->isGet && !\Yii::$app->request->isAjax) {
            throw new HttpException(400, 'Некорректный запрос');
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);

        $newComments = $compComments->getNewComments();
        if ($newComments) {
            return [
                'result' => true,
                'new_comments' => $newComments,
                'notif_count' => count($newComments),
                ];
        }

        return [
            'result' => false,
            'new_comments' => $newComments,
            'notif_count' => count($newComments),
        ];
    }
}