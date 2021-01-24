<?php


namespace app\controllers\actions\site;


use app\components\ReportCommentsComponent;
use app\models\ReportComments;
use app\models\User;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class UpdateDataAction extends Action {
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

        return ['result' => false];
    }
}