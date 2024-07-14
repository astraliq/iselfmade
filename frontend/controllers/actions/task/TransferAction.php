<?php


namespace frontend\controllers\actions\task;


use frontend\components\TasksComponent;
use frontend\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class TransferAction extends Action {
    public function run() {

        if (!\Yii::$app->request->isPost || !\Yii::$app->rbac->canCreateTask()) {
            throw new HttpException(403,'Нет доступа');
        }

        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        if (\Yii::$app->request->isPost) {
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
            }
            $type_id = \Yii::$app->request->post()['type'];
            $res = $comp->renewLastUnfinishedTasks($type_id);
            if ($res) {
                $widgetData = $comp->getWidgetData($type_id, 0);

                return ['result' => true, 'tasks' => \frontend\widgets\tasks\TasksViewWidget::widget([
                    'title' => $widgetData['title'],
                    'tasks' => $widgetData['tasks'],
                    'del' => false,
                    'type_id' => $type_id,
                    'model' => $model,
                    'nextPeriod' => 0,
                ])];
            } else {
                return ['result' => false];
            }
        }

//        echo '<pre>';
//        print_r($model);
//        echo '</pre>';
//        exit();
        return $this->controller->redirect([\Yii::$app->params['links']['report']]);
    }
}