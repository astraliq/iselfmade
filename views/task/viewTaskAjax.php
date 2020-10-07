<?php
use yii\helpers\Html;

if ($task->finished == 1) {
    echo '<li class="text__list_item text__list_item_checked">' . Html::encode($task->task);
} else {
    echo '<li class="text__list_item">' . Html::encode($task->task);
}
echo '</li>';
echo '<span class="tasks__list_create">' . Html::encode($task->date_create_view) . '</span>';
echo '<a href="/task/change/' . $task->id . '">Изменить</a>';
echo '<a href="/task/del/' . $task->id . '" style="margin: 0 40px 0 40px">Удалить</a>';
if ($task->finished == 1) {
    echo '<a href="/task/finish/' . $task->id . '">Вернуть в работу</a>';
} else {
    echo '<a href="/task/finish/' . $task->id . '">Завершить</a>';
}
?>




