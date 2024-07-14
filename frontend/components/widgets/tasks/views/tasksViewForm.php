<?php
/**
 * @var $title - заголовок */

use yii\helpers\Html;
$finished = '';
$check = '';
if ($disabled) {
    $disabled_text = 'disabled_text';
} else {
    $disabled_text = '';
}
?>

<div class="tasks__list" id="tasks__list-<?=$block_id?>" data-type="<?=$type_id?>" data-next_period="<?=$nextPeriod?>">
    <?php
    if ($type_id==2 || $type_id==3) {
        $disableEdit = '';
        $activeClass = '';
    } else {
        $disableEdit = 'disabled';
        $activeClass = 'disabled_hidden';
    }
    ?>
    <input id="task-<?=$type_id?>-<?=$nextPeriod?>" class="hide_input" type="checkbox" <?=$disableEdit?>>
    <label for="task-<?=$type_id?>-<?=$nextPeriod?>" class="main__data_title main__data_line <?=$activeClass?> <?=$disabled_text?>"><?= Html::encode($title) ?></label>
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
        if ($nextPeriod == 0 && $type_id != 1) {
            echo '<a class="tasks_show_finished" data-show="1">(Скрыть завершенные)</a>';
        }

    ?>
    <span class="saving_tasks">Сохранено</span>
    <ol class="text__list_items">
        <?php
        if ($tasks) {
            foreach ($tasks as $task) {
                echo \frontend\components\widgets\tasks\OneTaskViewWidget::widget([
                    'task' => $task,
                    'type_id' => $type_id,
                    'nextPeriod' => $nextPeriod,
                    'newTask' => 0,
                    'repeatedTask' => false,
                    'disabled' => $disabled,
                ]);
            }
        }
        if (!$disabled) {
            echo \frontend\components\widgets\tasks\OneTaskViewWidget::widget(
                [
                    'task' => '',
                    'type_id' => $type_id,
                    'nextPeriod' => $nextPeriod,
                    'newTask' => 1,
                    'repeatedTask' => false,
                    'disabled' => $disabled,
                ]
            );
        }
        ?>
    </ol>


</div>