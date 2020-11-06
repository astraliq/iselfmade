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

?>


<li class="text__list_item created_tasks <?=$finished ?>" data-next_period="<?=$nextPeriod?>" data-type="<?=$task->type_id?>" data-private_id="<?=$task->private_id?>">
    <div class="task__input_block">
        <textarea class="task__input" data-type="<?=$task->type_id?>" data-next_period="<?=$nextPeriod?>" data-finished="<?=$task->finished?>" data-id="<?=$task->id?>" type="text" maxlength="70"><?=Html::encode($task->task)?></textarea>
        <button class="check_btn icon-<?=$check?>"></button>
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
