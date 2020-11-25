<?php

use yii\helpers\Html;
$finished = '';
$check = '';


if ($task->finished == 1) {
    $finished = 'text__strike';
    $check = 'check';
} else {
    $finished = '';
    $check = 'check-empty';
}


$privateSelect = [];
if ($task->private_id) {
    $privateSelect[$task->private_id] = 'selected';
} else {
    $privateSelect[1] = 'selected';
}

$repeatTypeSelect = [];
if (!$task->repeated_by_id) {
    $repeatTypeId = $task->repeat_type_id;
} else {
    $repeatTypeId = $task->parent_repeat_type;
}
if ($repeatTypeId) {
    $repeatTypeSelect[$repeatTypeId] = 'selected';
} else {
    $repeatTypeSelect[0] = 'selected';
}

if ($task->repeated_by_id) {
    $disableRepeateAttr = 'disabled';
    $disableRepeatClass = 'disabled_repeat';
    $disableRepeatTitle = 'Для изменения повтора данной задачи передите в раздел <Повторяющиеся задачи>';
} else {
    $disableRepeateAttr = '';
    $disableRepeatClass = '';
    $disableRepeatTitle = '';
}
$weekdaysCheckedInputs = [];
if (!$task->repeated_by_id) {
    $weekdaysIds = explode(',', $task->repeated_weekdays);
} else {
    $weekdaysIds = explode(',', $task->parent_repeated_weekdays);
}

foreach ($weekdaysIds as $id) {
    $weekdaysCheckedInputs[$id] = 'checked';
}


$createdTaskClass = $newTask == 0 ? 'created_tasks' : '';
$newInputClass = $newTask == 1 ? 'new_input_task' : '';
$weekdaysShowClass = $repeatTypeId != 8 ? 'hidden_block_anim' : '';
$typeId = $newTask == 1 ? $type_id : $task->type_id;

?>
<li class="text__list_item <?=$createdTaskClass?> <?=$finished?>" data-next_period="<?=$nextPeriod?>" data-type="<?=$task->type_id?>" data-private_id="<?=$task->private_id?>">
    <div class="task__input_block">
        <textarea class="task__input <?=$newInputClass?>" data-type="<?=$typeId?>" data-next_period="<?=$nextPeriod?>" data-finished="<?=$task->finished?>" data-id="<?=$task->id?>" data-repeated_by_id="<?=$task->repeated_by_id?>" type="text" maxlength="70"><?=Html::encode($task->task)?></textarea>
        <?php
        if ($newTask == 0 && !$repeatedTask) {
            echo '<button class="check_btn icon-' . $check . '"></button>';
        }
        if ($repeatedTask) {
            echo '<p class="next_repeat_date_row">Следующий повтор: <span class="next_repeat_date" id="repeated-' . $task->id . '" data-id="' . $task->id . '">' . $task->nextRepeatDate . '</span></p>';
        }
        ?>
        <div class="task__settings">
            <div class="select_block">
                <div class="label_block">
                    <label for="private_id">Видимость:</label>
                </div>
                <select name="private_id" class="private_id">
                    <option value="1" <?=$privateSelect[1]?>>Видна всем</option>
                    <option value="2" <?=$privateSelect[2]?>>Видна только бадди</option>
                    <option value="3" <?=$privateSelect[3]?>>Видна только куратору</option>
                    <option value="4" <?=$privateSelect[4]?>>Видна только мне</option>
                </select>
            </div>
            <div class="select_block">
                <div class="label_block">
                    <span>Повтор:</span>
                </div>
                <select name="repeated_by_id" class="repeated_by_id <?=$disableRepeatClass?>" <?=$disableRepeateAttr?> title="<?=$disableRepeatTitle?>">
                    <option value="0" <?=$repeatTypeSelect[0]?>>Без повтора</option>
                    <option value="1" <?=$repeatTypeSelect[1]?>>Ежедневно</option>
                    <option value="2" <?=$repeatTypeSelect[2]?>>Раз в месяц</option>
                    <option value="3" <?=$repeatTypeSelect[3]?>>Раз в год</option>
                    <option value="4" <?=$repeatTypeSelect[4]?>>Раз в квартал</option>
                    <option value="5" <?=$repeatTypeSelect[5]?>>Раз в неделю</option>
                    <option value="6" <?=$repeatTypeSelect[6]?>>По будням</option>
                    <option value="7" <?=$repeatTypeSelect[7]?>>По выходным</option>
                    <option value="8" <?=$repeatTypeSelect[8]?>>По дням недели</option>
                </select>

            </div>
            <div class="weekends_block <?=$weekdaysShowClass?>">
                <div class="repeat_weekdays">
                    <input type="checkbox" data-id="1" <?=$weekdaysCheckedInputs[1]?> <?=$disableRepeateAttr?>><span>Пн</span>
                    <input type="checkbox" data-id="2" <?=$weekdaysCheckedInputs[2]?> <?=$disableRepeateAttr?>><span>Вт</span>
                    <input type="checkbox" data-id="3" <?=$weekdaysCheckedInputs[3]?> <?=$disableRepeateAttr?>><span>Ср</span>
                    <input type="checkbox" data-id="4" <?=$weekdaysCheckedInputs[4]?> <?=$disableRepeateAttr?>><span>Чт</span>
                    <input type="checkbox" data-id="5" <?=$weekdaysCheckedInputs[5]?> <?=$disableRepeateAttr?>><span>Пт</span>
                    <input type="checkbox" data-id="6" <?=$weekdaysCheckedInputs[6]?> <?=$disableRepeateAttr?>><span>Сб</span>
                    <input type="checkbox" data-id="7" <?=$weekdaysCheckedInputs[7]?> <?=$disableRepeateAttr?>><span>Вс</span>
                </div>
            </div>
        </div>
    </div>
</li>
