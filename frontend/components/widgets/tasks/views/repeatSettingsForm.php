<?php

if ($task && $task->repeat_start) {
    $typeInputStart = 'date';
    $typeInputStartValue = $task->repeat_start;
} else {
    $typeInputStart = 'text';
    $typeInputStartValue = 'При создании';
}
if ($task && $task->repeat_end) {
    $typeInputEnd = 'date';
    $typeInputEndValue = $task->repeat_end;
} else {
    $typeInputEnd = 'text';
    $typeInputEndValue = 'Бессрочно';
}

$typeInputEnd = $task && $task->repeat_end ? 'date' : 'text';

if ($repeat_created == 1) {
    $repeatTypeSelectNOT = '';
} else {
    $repeatTypeSelectNOT = '<option value="0" ' . $repeatTypeSelect[0] . '>Нет</option>';
}



/* @var $this \yii\web\View */
/* @var $disableRepeatClass  */
/* @var $disableRepeateAttr  */
/* @var $disableRepeatTitle  */
/* @var $repeatTypeSelect  */
/* @var $weekdaysShowClass  */
/* @var $weekdaysCheckedInputs  */
?>

<div class="select_block" >
    <div class="label_block">
        <label for="repeated_by_id">Повторять:</label>
    </div>
    <select name="repeated_by_id" class="repeated_by_id <?=$disableRepeatClass?>" <?=$disableRepeateAttr?> title="<?=$disableRepeatTitle?>">
        <?=$repeatTypeSelectNOT?>
        <option value="1" <?= $repeatTypeSelect[1] ?? null ?>>Ежедневно</option>
        <option value="2" <?= $repeatTypeSelect[2] ?? null ?>>Раз в месяц</option>
        <option value="3" <?= $repeatTypeSelect[3] ?? null ?>>Раз в год</option>
        <option value="4" <?= $repeatTypeSelect[4] ?? null ?>>Раз в квартал</option>
        <option value="5" <?= $repeatTypeSelect[5] ?? null ?>>Раз в неделю</option>
        <option value="6" <?= $repeatTypeSelect[6] ?? null ?>>По будням</option>
        <option value="7" <?= $repeatTypeSelect[7] ?? null ?>>По выходным</option>
        <option value="8" <?= $repeatTypeSelect[8] ?? null ?>>По дням недели</option>
    </select>
</div>
<div class="weekends_block <?=$weekdaysShowClass?>">
    <div class="repeat_weekdays">
        <input type="checkbox" data-id="1" <?= $weekdaysCheckedInputs[1] ?? null ?> <?=$disableRepeateAttr?>><span>Пн</span>
        <input type="checkbox" data-id="2" <?= $weekdaysCheckedInputs[2] ?? null ?> <?=$disableRepeateAttr?>><span>Вт</span>
        <input type="checkbox" data-id="3" <?= $weekdaysCheckedInputs[3] ?? null ?> <?=$disableRepeateAttr?>><span>Ср</span>
        <input type="checkbox" data-id="4" <?= $weekdaysCheckedInputs[4] ?? null ?> <?=$disableRepeateAttr?>><span>Чт</span>
        <input type="checkbox" data-id="5" <?= $weekdaysCheckedInputs[5] ?? null ?> <?=$disableRepeateAttr?>><span>Пт</span>
        <input type="checkbox" data-id="6" <?= $weekdaysCheckedInputs[6] ?? null ?> <?=$disableRepeateAttr?>><span>Сб</span>
        <input type="checkbox" data-id="7" <?= $weekdaysCheckedInputs[7] ?? null ?> <?=$disableRepeateAttr?>><span>Вс</span>
    </div>
</div>
<div class="dates ?? null _block <?=$repeatDatesShowClass?>" >
    <div class="label_block">
        <label for="repeated_start">Начало повтора:</label>
    </div>
    <input type="<?=$typeInputStart?>" class="repeated_date rep_date_start <?=$disableRepeatClass?>" <?=$disableRepeateAttr?> title="<?=$disableRepeatTitle?>" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'; if (!this.value) {this.value='При создании';}}" value="<?=$typeInputStartValue?>">
</div>
<div class="dates_block <?=$repeatDatesShowClass?>" >
    <div class="label_block">
        <label for="repeated_by_id">Конец повтора:</label>
    </div>
    <input type="<?=$typeInputEnd?>" class="repeated_date rep_date_end <?=$disableRepeatClass?>" <?=$disableRepeateAttr?> title="<?=$disableRepeatTitle?>" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'; if (!this.value) {this.value='Бессрочно';}}" value="<?=$typeInputEndValue?>">
</div>



