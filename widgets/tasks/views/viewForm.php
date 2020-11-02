<?php
/**
 * @var $title - заголовок */

use yii\helpers\Html;

?>

<div class="tasks__list row">
    <a class="main__data_title main__data_line"><?= Html::encode($title) ?></a>
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
        if (!$nextPeriod) {
            echo '<button class="task_transfer_btn icon-arrow-curved" ' . $active .' data-type="' . $type_id . '" title="' . $btnName . '"></button>';
        }
    ?>
    <ol class="text__list_items">
        <?php
        if ($tasks) {
            foreach ($tasks as $task) {
                if ($task->finished == 1) {
                    echo '<li class="text__list_item text__strike">' . Html::encode($task->task);
                } else {
                    echo '<li class="text__list_item">' . Html::encode($task->task);
                }
                echo '</li>';
                echo '<span class="tasks__list_create">' . Html::encode($task->date_create_view) . '</span>';

                if ($del) {
                    echo '<a href="/task/restore/' . $task->id . '">Восстановить</a>';
                    echo '<a href="/task/hard-del/' . $task->id . '" style="margin: 0 40px 0 40px">Удалить навсегда</a>';
                } else {
                    echo '<a href="/task/change/' . $task->id . '">Изменить</a>';
                    echo '<a href="/task/del/' . $task->id . '" style="margin: 0 40px 0 40px">Удалить</a>';
                    if ($task->finished == 1) {
                        echo '<a href="/task/finish/' . $task->id . '">Вернуть в работу</a>';
                    } else {
                        echo '<a href="/task/finish/' . $task->id . '">Завершить</a>';
                    }

                }

            }
        } else {
            echo '<p class="text__list_empty">Список задач пуст</p>';
        }
        ?>
        <li class="text__list_item">
            <?php
            if (!$del) {
//                $form = \yii\bootstrap\ActiveForm::begin(['action' => 'task/create']);
//            echo    $form->field($model,'type_id',['enableClientValidation'=>false, 'enableAjaxValidation'=>true,'options' => ['class' => 'hidden_block'],])->dropDownList($model::TYPE_TASK)->hiddenInput(['value'=>$type_id])->label(false);
//            echo $form->field($model,'task')->textarea()->label(false);
//            echo $form->field($model,'private_id',['enableClientValidation'=>false, 'enableAjaxValidation'=>true])->dropDownList($model::TASK_PRIVATE,['options' =>[ '1' => ['Selected' => true]]]);
//            echo '<button type="submit" class="btn btn-default">Добавить</button>';
//            \yii\bootstrap\ActiveForm::end();
                echo '<div class="task__input_block">';
                echo '<textarea class="task__input" data-type="' . $type_id .'" data-next_period="' . $nextPeriod .'"></textarea>';
                echo '<div class="task__settings">
                        <label for="private_id">Доступность:</label>
                        <select name="private_id" id="private_id">
                            <option value="1" selected>Видна всем</option>
                            <option value="2">Видна только бадди</option>
                            <option value="3">Видна только куратору</option>
                            <option value="4">Видна только мне</option>
                        </select>
                    </div>';
                echo '</div>';

            }
            ?>
        </li>


    </ol>


</div>






