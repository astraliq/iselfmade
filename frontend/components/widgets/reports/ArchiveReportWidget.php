<?php


namespace frontend\components\widgets\reports;


use yii\base\Widget;

class ArchiveReportWidget extends Widget {

    public $title;
    public $report;
    public $tasks;
    public $date;
    public $grade;
    public $comments;
    public $self;

    public function run() {

        return $this->render('archiveReportViewForm',[
            'title' => $this->title,
            'report' => $this->report,
            'tasks' => $this->tasks,
            'date' => $this->date,
            'grade' => $this->grade,
            'userId' => \Yii::$app->user->getId(),
            'comments' => $this->comments,
            'self' => $this->self,
        ]);
    }

}