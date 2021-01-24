<?php


namespace app\widgets\tasks;


use app\models\Tasks;
use yii\base\Widget;

class TasksViewWidget extends Widget {

    public $title;
    public $tasks;
    public $del;
    public $model;
    public $type_id;
    public $nextPeriod;
    public $renewLast;
    public $block_id;
    public $disabled;


    public function run() {

        return $this->render('tasksViewForm',[
            'title' => $this->title,
            'tasks' => $this->tasks,
            'del' => $this->del,
            'type_id' => $this->type_id,
            'nextPeriod' => $this->nextPeriod,
            'renewLast' => $this->renewLast,
            'model' => $this->model,
            'block_id' => $this->block_id,
            'disabled' => $this->disabled,
            ]);
    }

}