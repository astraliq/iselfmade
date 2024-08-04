<?php

namespace frontend\components\widgets\tasks;

use frontend\models\Tasks;
use yii\base\Widget;

class OneTaskViewWidget extends Widget {

    public ?Tasks $task;
    public $nextPeriod;
    public $newTask;
    public $type_id;
    public $repeatedTask;
    public $disabled;
    public $advanced;
    public $repeat_created;


    public function run() {

        return $this->render('oneTaskViewForm',[
            'task' => $this->task,
            'nextPeriod' => $this->nextPeriod,
            'newTask' => $this->newTask,
            'type_id' => $this->type_id,
            'repeatedTask' => $this->repeatedTask,
            'disabled' => $this->disabled,
            'advanced' => $this->advanced,
            'repeat_created' => $this->repeat_created,
        ]);
    }
}