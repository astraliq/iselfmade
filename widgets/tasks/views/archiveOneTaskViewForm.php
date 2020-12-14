<?php

use yii\helpers\Html;
$finished = '';

if ($task->finished == 1) {
    $finished = 'text__strike';
} else {
    $finished = '';
}

?>
<li class="text__list_item <?=$finished?>" data-private_id="<?=$task->private_id?>" data-id="<?=$task->id?>" data-finished="<?=$task->finished?>" data-repeated_by_id="<?=$task->repeated_by_id?>">
    <?=Html::encode($task->task)?>
</li>
