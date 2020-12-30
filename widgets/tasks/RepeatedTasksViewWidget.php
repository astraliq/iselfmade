<?php


namespace app\widgets\tasks;


use app\models\Tasks;
use yii\base\Widget;

class RepeatedTasksViewWidget extends Widget {

    public $title;
    public $task;

    public function run() {
        return $this->render('repeatedTaskViewForm',[
            'task' => $this->task,
            ]);
    }

}