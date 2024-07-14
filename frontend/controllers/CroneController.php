<?php

namespace frontend\controllers;

use common\base\BaseController;
use frontend\controllers\actions\crone\CuratorReportsAction;
use frontend\controllers\actions\crone\RepeatTasksAction;
use yii\web\HttpException;

class CroneController extends BaseController {
    public $layout = 'base';

    /**
     * @throws HttpException
     */
    public function actions() {
        if (YII_ENV === 'dev') {
            return [
                'repeat-tasks' => ['class' => RepeatTasksAction::class],
                'curator-reports' => ['class' => CuratorReportsAction::class],
            ];
        } else {
            throw new HttpException(404, 'Страница не найдена');
        }
    }

    public function beforeAction($action){
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}