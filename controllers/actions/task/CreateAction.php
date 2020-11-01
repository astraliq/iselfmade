<?php


namespace app\controllers\actions\task;


use app\components\TasksComponent;
use app\models\Tasks;
use app\models\User;
use yii\base\Action;
use yii\bootstrap\ActiveForm;
use yii\web\HttpException;
use yii\web\Response;

class CreateAction extends Action {
    public $view;

    public function run($user_id=null, $id=null) {
////        \Yii::$app->setTimeZone('UTC');
//        $date1 = date('Y-m-d H:i:s');
//        $date2 = \Yii::$app->formatter->asDateTime('2020-10-04 10:10:10', 'php:d F Y, H:i:s');
////        \Yii::$app->setTimeZone(\Yii::$app->user->getIdentity()->getTimezone());
//        $date3 = time();
////        echo $test;
//        echo '<br>';
//        echo $date1;
//        echo '<br>';
//        echo $date2;
//        echo '<br>';
//        echo $date3;
//        echo '<br>';
//        echo \Yii::$app->user->getIdentity()->getTimezone();
//        exit();

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canCreateTask()) {
            throw new HttpException(403,'Нет доступа');
        }
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();
        $action = $this->id;
        $task = $model;

        if ($action == 'change') {
            $task = $model->findOne(['id' => $id, 'user_id' => \Yii::$app->user->getId()]);
            if (!\Yii::$app->user->can('updateOwnTasks', ['task' => $task])) {
                throw new HttpException(403,'Нет доступа');
            }
            \Yii::$app->rbac->canAccessCRUDTask($id, $task, $user_id);
        } elseif ($action == 'create') {
            if (!\Yii::$app->user->can('createTasks')) {
                throw new HttpException(403,'Вы не можете создать задачу');
            }
        }
//        echo '<pre>';
//        print_r($task);
//        echo '</pre>';
//        exit();
        if (\Yii::$app->request->isPost) {
            $task->load(\Yii::$app->request->post());
//            $data = \Yii::$app->request->post();
//            \Yii::$app->response->format = Response::FORMAT_JSON;
//            return $data;
//            exit();

            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
            }

            if ($comp->addTask($task)) {
//                $lastPage = \Yii::$app->session->getFlash('lastPage');
//                return $this->controller->redirect($lastPage);
//                return $this->controller->redirect(['/task/view/' . $task->id]);
                if (\Yii::$app->request->isAjax) {
                    $widgetData = $comp->getWidgetData($task->type_id, $task->nextPeriod);

                    return ['result' => true, 'tasks' => \app\widgets\tasks\TasksViewWidget::widget([
                        'title' => $widgetData['title'],
                        'tasks' => $widgetData['tasks'],
                        'del' => false,
                        'type_id' => $task->type_id,
                        'model' => $model,
                        'nextPeriod' => $widgetData['nextPeriod'],
                        'renewLast' => $comp->checkDataToRenew($task->type_id),
                    ])];
                } else {
                    return $this->controller->redirect(['/report']);
                }
            } else {
                if (\Yii::$app->request->isAjax) {
                    return ['result' => 'false'];
                } else {
                    return $this->controller->redirect(['/report']);
                }
//                echo '<pre>';
//                print_r($model->getErrors());
//                echo '</pre>';
            }
        }

        $aims = $comp->getAllAimsArr();
        $goals = $comp->getAllGoalsArr();

        $model = ($action == 'change') ? $task : $model;

//        echo '<pre>';
//        print_r($model);
//        echo '</pre>';
//        exit();
        return $this->controller->render($this->view, [
            'model' => $model,
            'aims' => $aims,
            'goals' => $goals,
            'action' => $action
        ]);
    }
}