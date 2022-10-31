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
//        echo '<pre>';
//        echo 'проверка!';
//        echo '</pre>';
//        exit();
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $repeat = $comp->createRepeatedTasks();
        if ($repeat) {
            echo get_class($this) . ' DONE!';
            return true;
        }
        echo '<pre>';
        print_r($repeat);
        echo '</pre>';
        return false;
    }
}