<?php


namespace app\widgets\tasks;




use yii\base\Widget;

class OneTaskViewWidget extends Widget {

    public $task;
    public $nextPeriod;
    public $newTask;
    public $type_id;
    public $repeatedTask;
    public $disabled;


    public function run() {
        return $this->render('oneTaskViewForm',[
            'task' => $this->task,
            'nextPeriod' => $this->nextPeriod,
            'newTask' => $this->newTask,
            'type_id' => $this->type_id,
            'repeatedTask' => $this->repeatedTask,
            'disabled' => $this->disabled,
        ]);
    }
}