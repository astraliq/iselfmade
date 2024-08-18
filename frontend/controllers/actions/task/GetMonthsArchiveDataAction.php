<?php


namespace frontend\controllers\actions\task;

use frontend\components\TasksComponent;
use frontend\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class GetMonthsArchiveDataAction extends Action {
    public function run($month, $year) {

        if (\Yii::$app->user->isGuest) {
            return $this->controller->redirect('/');
        }
        if (!\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        if (!\Yii::$app->request->isGet) {
            throw new HttpException(400, 'Некорректный запрос' );
        }
        \Yii::$app->response->format=Response::FORMAT_JSON;

        $compTasks = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $modelTasks = $compTasks->getModel();

        $yesterdayDate = date('d.m.Y', strtotime( "-1 day"));
        $beforeYesterdayDate = date('d.m.Y', strtotime( "-2 day"));
        $today = date('d.m.Y');
        $unixToday = strtotime($today);
        $date = \Yii::$app->request->post()['date'] ?? null;
        $unixDate = $date ? strtotime($date) : null;

        $month++;

        $tasksData = $compTasks->getMonthsTasks($month, $year);

        //        $dateUTC = (new \DateTime(date($date)))->format('Y-m-d');
//        $archiveTasks = $comp->getArchiveTasksByDate($date, 2);
//        $gradeModel = new UsersReports();
//        $userGrade = $gradeModel->findOne(['user_id' => \Yii::$app->user->getId(), 'date' => $dateUTC])->mentor_grade;
        if ($tasksData) {
            return [
                'result' => true,
                'archive' => $tasksData,
            ];
        } else {
            return ['result' => false, 'message' => 'Ошибка.'];
        }

    }
}