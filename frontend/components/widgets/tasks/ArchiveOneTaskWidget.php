<?php


namespace frontend\components\widgets\tasks;


use yii\base\Widget;

class ArchiveOneTaskWidget extends Widget {
    public $task;

    public function run() {
        return $this->render('archiveOneTaskViewForm',[
            'task' => $this->task,
        ]);
    }
}