<?php


namespace app\controllers\actions\user;


use app\components\UserComponent;
use app\models\User;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PolicyAction extends Action {
    public function run() {
        $this->controller->layout = 'error_base';
        $param = '';
        return $this->controller->render('policy',[
            'param' => $param,
        ]);
    }
}