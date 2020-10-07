<?php
use yii\helpers\Html;
?>



<div class="task">
    <p>Дата создания: <span><?= $task->date_create ?></span></p>
    <p><?= $task->task ?></p>
    <p>Сделать до: <span><?= $task->date_calculate ?></span></p>
    <?php

    if ($task->deleted == 1) {
        echo '<a href="/task/restore/' . $task->id .
            '" style="display: inline-block; width: 100px;">Восстановить</a>';
        echo '<a href="/task/hard-del/' . $task->id . '">Удалить навсегда</a>';
    } else {
        echo '<a href="/task/change/' . $task->id .
            '" style="display: inline-block; width: 100px;">Изменить</a>';
        echo '<a href="/task/del/' . $task->id . '" style="margin: 0 40px 0 0">Удалить</a>';
        if ($task->finished == 1) {
            echo '<a href="/task/finish/' . $task->id . '">Вернуть в работу</a>';
        } else {
            echo '<a href="/task/finish/' . $task->id . '">Завершить</a>';
        }
    }
    echo '<br>';
    echo '<br>';
    if ($task->aim_id) {
        echo '<p>Является частью задачи: <a href="/task/view/' . $task->aim_id . '">' . $aims[$task->aim_id] . ' </a> </p>';
    }

    if ($task->goal_id) {
        echo '<p>Является частью цели: <a href="/task/view/' . $task->goal_id . '">' . $goals[$task->goal_id] . ' </a> </p>';
    }
    if (!empty($childTasks)) {
        echo '<p> Список подзадач:</p>';
        echo \app\widgets\tasks\ChildesViewWidget::widget([
            'childTasks' => $childTasks,
            'aims' => $aims,
            'tasks' => $tasks,
            'aim_type' => $task->type_id == 2 ? true : false,
        ]);
    }


    ?>

</div>