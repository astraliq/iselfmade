<?php


namespace app\controllers\actions\report;


use app\components\ReportsComponent;
use app\components\UserComponent;
use app\models\User;
use app\models\UsersReports;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class AddReportAction extends Action {
    public function run() {

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $compUser = \Yii::createObject(['class' => UserComponent::class,'modelClass' => User::class]);
        $user = $compUser->getModel();
        $userId = \Yii::$app->user->getId();
        $user = $user->findOne(['id' => $userId]);

        $compReports = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $report = $compReports->getModel();

        if (\Yii::$app->request->isPost) {
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
//                return ActiveForm::validate($user);
            }
            $postData = \Yii::$app->request->post();
            $report->date = date('Y-m-d');
            $report->user_id = $userId;
            $report->load($postData);

            if ($compReports->updateReport($report)) {
                return ['result' => true];
            }

        }

        return ['result' => false];
    }
}