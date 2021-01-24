<?php


namespace app\widgets\tasks;


use yii\base\Widget;

class CheckReportsWidget extends Widget {
    public $user;
    public $tasks;
    public $block_id;
    public $date;
    public $userReport;


    public function run() {
        return $this->render('checkTasksViewForm',[
            'user' => $this->user,
            'tasks' => $this->tasks,
            'block_id' => $this->block_id,
            'date' => $this->date,
            'userReport' => $this->userReport,
        ]);
    }
}