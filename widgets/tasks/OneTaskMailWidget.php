<?php


namespace app\widgets\tasks;


use yii\base\Widget;

class OneTaskMailWidget extends Widget {
    public $task;

    public function run() {
        return $this->render('oneTaskMailForm',[
            'task' => $this->task,
        ]);
    }
}