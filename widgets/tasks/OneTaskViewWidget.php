<?php


namespace app\widgets\tasks;




use yii\base\Widget;

class OneTaskViewWidget extends Widget {

    public $task;
    public $nextPeriod;
    public $newTask;
    public $type_id;
    public $disable_finish;


    public function run() {
//        echo '<pre>';
//        echo print_r($this->task);
//        echo '</pre>';
//        exit();
        return $this->render('oneTaskViewForm',[
            'task' => $this->task,
            'nextPeriod' => $this->nextPeriod,
            'newTask' => $this->newTask,
            'type_id' => $this->type_id,
            'disable_finish' => $this->disable_finish,
        ]);
    }
}