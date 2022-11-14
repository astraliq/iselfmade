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
    public function run() {
        $comp = \Yii::createObject(['class' => TasksComponent::class,'modelClass' => Tasks::class]);
        $repeat = $comp->createRepeatedTasks();
        if ($repeat) {
            return $this->controller->renderFile('@app/views/site/test.php',[
                'title' => get_class($this),
                'test' => get_class($this) . " DONE!",
            ]);
        }
        return $this->controller->renderFile('@app/views/site/test.php',[
            'title' => get_class($this),
            'test' => get_class($this) . " FALSE!",
        ]);
    }
}