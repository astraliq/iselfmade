<?php


namespace frontend\components\widgets\tasks;


use yii\base\Widget;

class ArchiveTasksWidget extends Widget {
    public $title;
    public $tasks;
    public $block_id;
    public $date;
    public $grade;
    public $comments;
    public $self;
    public $report;


    public function run() {
        return $this->render('archiveTasksViewForm',[
            'title' => $this->title,
            'date' => $this->date,
            'tasks' => $this->tasks,
            'block_id' => $this->block_id,
            'grade' => $this->grade,
            'comments' => $this->comments,
            'self' => $this->self,
            'report' => $this->report,
        ]);
    }
}