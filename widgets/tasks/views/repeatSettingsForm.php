<?php



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
        <option value="0" <?=$repeatTypeSelect[0]?>>Нет</option>
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


