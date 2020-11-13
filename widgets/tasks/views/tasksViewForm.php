<?php
/**
 * @var $title - заголовок */

use yii\helpers\Html;
$finished = '';
$check = '';

?>

<div class="tasks__list" data-type="<?=$type_id?>" data-next_period="<?=$nextPeriod?>">
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
                    'nextPeriod' => $nextPeriod,
                ]);
            }
        }
        ?>
        <li class="text__list_item" data-next_period="<?=$nextPeriod?>" data-type="<?=$type_id?>">
            <div class="task__input_block">
                <textarea class="task__input new_input_task" data-type="<?=$type_id?>" data-next_period="<?=$nextPeriod?>" maxlength="70"></textarea>
                <div class="task__settings">
                    <div class="select_block">
                        <div class="label_block">
                            <label for="private_id">Видимость:</label>
                        </div>
                        <select name="private_id" class="private_id">
                            <option value="1" selected>Видна всем</option>
                            <option value="2">Видна только бадди</option>
                            <option value="3">Видна только куратору</option>
                            <option value="4">Видна только мне</option>
                        </select>
                    </div>
                    <div class="select_block">
                        <div class="label_block">
                            <input type="checkbox" class="repeated"><span>Повтор:</span>
                        </div>
                        <select name="repeated_by_id" class="repeated_by_id">
                            <option value="1" selected>Ежедневно</option>
                            <option value="2">Раз в месяц</option>
                            <option value="3">Раз в год</option>
                            <option value="4">Раз в квартал</option>
                            <option value="5">Раз в неделю</option>
                            <option value="6">По будням</option>
                            <option value="7">По выходным</option>
                            <option value="8">По дням недели</option>
                        </select>

                    </div>
                    <div class="weekends_block">
                        <div class="repeat_weekdays">
                            <input type="checkbox" data-id="1"><span>Пн</span>
                            <input type="checkbox" data-id="2"><span>Вт</span>
                            <input type="checkbox" data-id="3"><span>Ср</span>
                            <input type="checkbox" data-id="4"><span>Чт</span>
                            <input type="checkbox" data-id="5"><span>Пт</span>
                            <input type="checkbox" data-id="6"><span>Сб</span>
                            <input type="checkbox" data-id="7"><span>Вс</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ol>
</div>