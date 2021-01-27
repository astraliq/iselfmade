<?php


namespace app\widgets\tasks;


use yii\base\Widget;

class ArchiveListOneTaskWidget extends Widget {
    public $report;
    public $number;
    public $tasksCount;
    public $finishedTasksCount;

    public function run() {
        return $this->render('archiveOneTaskList',[
            'report' => $this->report,
            'number' => $this->number,
            'tasksCount' => $this->tasksCount,
            'finishedTasksCount' => $this->finishedTasksCount,
        ]);
    }
}