<?php
/**
 * @var $title - заголовок */

use yii\helpers\Html;
$finished = '';
$check = '';

?>

<div class="tasks__list" id="tasks__list-<?=$block_id?>" data-type="<?=$type_id?>" data-next_period="<?=$nextPeriod?>">
    <?php
    if ($type_id==2 || $type_id==3) {
        $disabled = '';
        $activeClass = '';
    } else {
        $disabled = 'disabled';
        $activeClass = 'disabled_hidden';
    }
    ?>
    <input id="task-<?=$type_id?>-<?=$nextPeriod?>" class="hide_input" type="checkbox" <?=$disabled?>>
    <label for="task-<?=$type_id?>-<?=$nextPeriod?>" class="main__data_title main__data_line <?=$activeClass?>"><?= Html::encode($title) ?></label>
    <span class="saving_tasks">Сохранено</span>
    <?php
        switch ($type_id) {
            case 3:
                $btnName = 'Перенести незавершенные задачи с прошлого года';
                break;
            case 2:
                $btnName = 'Перенести незавершенные задачи с прошлого месяца';
                break;
            case 1:
                $btnName = 'Перенести незавершенные задачи за вчера';
                break;
        }
        $active = $renewLast ? '' : 'disabled';
        if (!$nextPeriod && $type_id==5) {
            echo '<button class="task_transfer_btn icon-arrow-curved" ' . $active .' data-type="' . $type_id . '" title="' . $btnName . '"></button>';
        }
    ?>
    <ol class="text__list_items">
        <?php
        if ($tasks) {
            foreach ($tasks as $task) {
                echo \app\widgets\tasks\OneTaskViewWidget::widget([
                    'task' => $task,
                    'type_id' => $type_id,
                    'nextPeriod' => $nextPeriod,
                    'newTask' => 0,
                    'repeatedTask' => false,
                ]);
            }
        }
        echo \app\widgets\tasks\OneTaskViewWidget::widget([
            'task' => '',
            'type_id' => $type_id,
            'nextPeriod' => $nextPeriod,
            'newTask' => 1,
            'repeatedTask' => false,
        ]);
        ?>


    </ol>
</div>