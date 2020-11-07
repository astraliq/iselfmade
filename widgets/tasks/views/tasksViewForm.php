<?php
/**
 * @var $title - заголовок */

use yii\helpers\Html;
$finished = '';
$check = '';

?>

<div class="tasks__list" data-type="<?=$type_id?>" data-next_period="<?=$nextPeriod?>">
    <a class="main__data_title main__data_line"><?= Html::encode($title) ?></a>
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
                    'nextPeriod' => $nextPeriod,
                ]);
            }
        }
        ?>
        <li class="text__list_item" data-next_period="<?=$nextPeriod?>" data-type="<?=$type_id?>">
            <div class="task__input_block">
                <textarea class="task__input new_input_task" data-type="<?=$type_id?>" data-next_period="<?=$nextPeriod?>" type="text" maxlength="70"></textarea>
                <div class="task__settings">
                    <label for="private_id">Доступность:</label>
                    <select name="private_id" id="private_id">
                        <option value="1" selected>Видна всем</option>
                        <option value="2">Видна только бадди</option>
                        <option value="3">Видна только куратору</option>
                        <option value="4">Видна только мне</option>
                    </select>
                </div>
            </div>
        </li>
    </ol>
</div>