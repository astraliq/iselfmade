<?php

use yii\helpers\Html;
$finished = '';

if ($task->finished == 1) {
    $finished = 'text-decoration: line-through;
        text-decoration-color: #b1b1b1;
        color: #b1b1b1;';
} else {
    $finished = '';
}

?>
<li class="text__list_item" style="<?=$finished?>"><?=Html::encode($task->task)?></li>
