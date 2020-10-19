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


    public function run() {
//        echo '<pre>';
//        echo print_r($this->model);
//        echo '</pre>';
//        exit();
        return $this->render('viewForm',[
            'title' => $this->title,
            'tasks' => $this->tasks,
            'del' => $this->del,
            'type_id' => $this->type_id,
            'nextPeriod' => $this->nextPeriod,
            'renewLast' => $this->renewLast,
            'model' => $this->model,
            ]);
    }

}