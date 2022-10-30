<?php

namespace app\controllers\actions\crone;

use app\components\TasksComponent;
use app\models\Tasks;
use yii\base\Action;
use yii\base\InvalidConfigException;

class RepeatTasksAction extends Action {
    /**
     * @throws InvalidConfigException
     */
    public function run(): bool {
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