<?php


namespace app\widgets\tasks;


use yii\base\Widget;

class ChildesViewWidget extends Widget {

    public $childTasks;
    public $aims;
    public $tasks;
    public $aim_type;

    public function run() {
        return $this->renderItems($this->childTasks);
    }

    private function renderItems($childTasks) {
        $arrChildes = $this->aim_type ? $childTasks[array_key_first($childTasks)] : $childTasks;
        $AimsTasks = $this->aims + $this->tasks;
        $html = '<ul class="child_tasks' . $i . '">';
        if (!empty($arrChildes)) {
            foreach ($arrChildes as $id => $arr) {
                $html .= '<li><a href="/task/view/' . $id . '">' . $id . ' => ' . $AimsTasks[$id] . '</a>';
                if (!empty($arr)) {
                    $html .= $this->renderItems($arr);
                }
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

}