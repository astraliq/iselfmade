<?php


namespace app\widgets\tasks;


use yii\base\Widget;

class ArchiveTasksListWidget extends Widget {
    public $reports;
    public $tasksCountReports;


    public function run() {
        return $this->render('archiveTasksList',[
            'reports' => $this->reports,
            'tasksCountReports' => $this->tasksCountReports,
        ]);
    }
}