<?php


namespace app\controllers\actions\task;


use app\Components\TasksComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class TransferAction extends Action {
    public function run($type) {
        if (!\Yii::$app->rbac->canCreateTask()) {
            throw new HttpException(403,'Нет доступа');
        }
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $model = $comp->getModel();

        if (\Yii::$app->request->isPost) {
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
            }

        }
        $res = $comp->renewLastUnfinishedTasks($type);
        echo $res;
        exit();
//        echo '<pre>';
//        print_r($model);
//        echo '</pre>';
//        exit();
        return $this->controller->redirect(['/report']);
    }
}