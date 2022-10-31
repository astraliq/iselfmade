<?php
use yii\helpers\Html;
$finished = '';
$check = '';
error_reporting(E_ALL & ~E_NOTICE);

/**
 * @var $task - задачи
 * @var $repeatedTask - повторяемые задачи
 * @var $type_id - тип задач
 * @var $repeat_created - повторная задача создана?
 * @var $nextPeriod - период задач
 * @var $disabled - флаг заблокированной (отключенной) задачи
 * @var $newTask - новая задача
 */
if ($task && $task->finished == 1 && !$repeatedTask) {
        $finished = 'text__strike';
        $check = 'check';
} else {
    $finished = '';
    $check = 'check-empty';
}

if ($type_id == 1) {
    $privateSet = 'Приватное';
    $no_privateSet = 'Не личное';
} else {
    $privateSet = 'Приватная';
    $no_privateSet = 'Не личная';
}


$privateSelect = [];
if ($task) {
    if ($task->private_id) {
        $privateSelect[$task->private_id] = 'selected';
    }
} else {
    $privateSelect[1] = 'selected';
}

$repeatTypeSelect = [];
if ($task) {
    if (!$task->repeated_by_id) {
        $repeatTypeId = $task->repeat_type_id;
    } else {
    $repeatTypeId = $task->parent_repeat_type;
    }
} else {
    $repeatTypeId = null;
}

if ($repeatTypeId) {
    $repeatTypeSelect[$repeatTypeId] = 'selected';
} else {
    if ($repeat_created == 1) {
        $repeatTypeSelect[1] = 'selected';
    } else {
        $repeatTypeSelect[0] = 'selected';
    }
}

if ($task) {
    if ($task->repeated_by_id || $type_id == 2 || $type_id == 3) {
        $disableRepeatAttr = 'disabled';
        $disableRepeatClass = 'disabled_repeat';
        $disableRepeatTitle = 'Для изменения повтора данной задачи передите в раздел <Повторяющиеся задачи>';
    }
} else {
    $disableRepeatAttr = '';
    $disableRepeatClass = '';
    $disableRepeatTitle = '';
}
$weekdaysCheckedInputs = [];
if ($task) {
    if (!$task->repeated_by_id) {
        $weekdaysIds = explode(',', $task->repeated_weekdays);
    } else {
        $weekdaysIds = explode(',', $task->parent_repeated_weekdays);
    }
} else {
    $weekdaysIds = [];
}

foreach ($weekdaysIds as $id) {
    $weekdaysCheckedInputs[$id] = 'checked';
}


if ($disabled) {
    $disabled_text = 'disabled_text';
    $displayNone = 'style="display: none"';
    $disableEdit = 'disabled';
} else {
    $disabled_text = '';
    $displayNone = '';
    $disableEdit = '';
}

$createdTaskClass = $newTask == 0 ? 'created_tasks' : '';
$newInputClass = $newTask == 1 ? 'new_input_task' : '';
$weekdaysShowClass = $repeatTypeId != 8 ? 'hidden_block_anim' : '';
if ($repeat_created == 1) {
    $repeatDatesShowClass = '';
} elseif ($repeatTypeId == 0) {
    $repeatDatesShowClass = 'hidden_block_anim';
} else {
    $repeatDatesShowClass = '';
}

$typeId = $newTask == 1 ? $type_id : $task->type_id;

?>
<li class="text__list_item <?=$createdTaskClass?> <?=$finished?>" data-next_period="<?=$nextPeriod?>" data-type="<?=$task->type_id??null?>" data-private_id="<?=$task->private_id??null?>">
    <div class="task__input_block">
        <textarea class="task__input <?=$newInputClass?>" data-type="<?=$typeId?>" data-next_period="<?=$nextPeriod?>" data-finished="<?=$task->finished??null?>" data-deleted="<?=$task->deleted??null?>" data-id="<?=$task->id??null?>" data-repeated_by_id="<?=$task->repeated_by_id??null?>" type="text" maxlength="70" <?=$disableEdit?> data-repeat_created="<?=$repeat_created?>"><?=nl2br(Html::encode($task->task??null))?></textarea>
        <?php
        if ($newTask == 0 && !$repeatedTask && !$disabled) {
            echo '<button class="check_btn icon-' . $check . '"></button>';
        }
        if ($newTask == 0 && !$disabled) {
            echo '<button class="delete_btn" data-id="' . $task->id . '">+</button>';
        }
        if ($repeatedTask) {
            echo '<p class="next_repeat_date_row">Следующий повтор: <span class="next_repeat_date" id="repeated-' . $task->id . '" data-id="' . $task->id . '">' . $task->nextRepeatDate . '</span></p>';
        }
        ?>
        <div class="task__settings">
            <div class="select_block">
                <div class="label_block">
                    <label for="private_id"><?=$privateSet?>:</label>
                </div>
                <select name="private_id" class="private_id">
                    <option value="1" <?=$privateSelect[1]?>>Нет</option>
                    <option value="2" <?=$privateSelect[2]??null?>>Да</option>
                </select>
            </div>
            <?php
            if ($type_id == 1 || $repeatedTask) {
                echo \app\widgets\tasks\RepeatSettingsWidget::widget([
                    'task' => $task,
                    'disableRepeatClass' => $disableRepeatClass,
                    'disableRepeateAttr' => $disableRepeatAttr,
                    'disableRepeatTitle' => $disableRepeatTitle,
                    'repeatTypeSelect' => $repeatTypeSelect,
                    'weekdaysShowClass' => $weekdaysShowClass,
                    'repeatDatesShowClass' => $repeatDatesShowClass,
                    'weekdaysCheckedInputs' => $weekdaysCheckedInputs,
                    'repeat_created' => $repeat_created,
                ]);
            }
            ?>
        </div>
        <div class="task__settings task__settings_delete">
            <p class="delete_q">Удалить </p>
            <btn class="btn_confirm" data-id="<?=$task->id??null?>">Да</btn>
            <btn class="btn_cancel"">Нет</btn>
        </div>
    </div>
</li>
