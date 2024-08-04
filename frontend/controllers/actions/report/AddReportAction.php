<?php


namespace frontend\controllers\actions\report;


use frontend\components\ReportsComponent;
use frontend\components\TasksComponent;
use frontend\components\UserComponent;
use frontend\models\Tasks;
use common\models\User;
use frontend\models\UsersReports;
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

        $compTasks = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $tasks = $compTasks->getTodayUserTasks();

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

            if (count($tasks) == 0) {
                return [
                    'result' => false,
                    'error_text' => 'Список дел на сегодня пуст.',
                ];
            }

            if (!$report->validate()) {
                $var = array_keys($report->errors);
                return [
                    'result' => false,
                    'error_text' => $report->errors[$var[0]],
                ];
            }

            if ($compReports->updateReport($report)) {
                return ['result' => true];
            }

        }

        return [
            'result' => false,
            'error_text' => 'Ошибка.',
        ];
    }
}