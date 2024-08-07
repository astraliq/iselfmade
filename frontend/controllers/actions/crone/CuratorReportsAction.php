<?php

namespace frontend\controllers\actions\crone;

use frontend\components\TasksComponent;
use frontend\models\Tasks;
use yii\base\Action;
use yii\base\InvalidConfigException;

class CuratorReportsAction extends Action {
    /**
     * @throws InvalidConfigException
     */
    public function run(): bool {
//        echo '<pre>';
//        echo 'проверка!';
//        echo '</pre>';
//        exit();
        $comp = \Yii::createObject(['class' => TasksComponent::class, 'modelClass' => Tasks::class]);
        $sends = $comp->sendReportsToCurators();
        if ($sends) {
            echo get_class($this) . ' DONE!';
            return true;
        }
        echo '<pre>';
        print_r($sends);
        echo '</pre>';
        return false;
    }
}