<?php

/* @var $this yii\web\View */


use yii\helpers\Html;

?>
<div class="tasks-all repeated-all">
    <div class="tasks__list" id="tasks__list-0" data-type="0">
        <h3 class="main__data_title repeated_title">Повторяющиеся дела</h3>
        <span class="saving_tasks">Сохранено</span>
        <ol class="text__list_items">
            <?php
            if ($repeatedTasks) {
                foreach ($repeatedTasks as $task) {
                    echo \app\widgets\tasks\OneTaskViewWidget::widget(
                        [
                            'task' => $task,
                            'repeatedTask' => true,
                        ]
                    );
                }
            } else {
                echo '<p style="font-style: italic; font-size: 12px">Список пуст</p>';
            }
            ?>
        </ol>
    </div>
</div>
<!--<div class="tasks-all">-->
<!--    --><?//= \app\widgets\tasks\TasksViewWidget::widget([
//        'title' => 'Повторяющиеся задачи',
//        'tasks' => $repeatedTasks,
//        'del' => false,
//        'type_id' => 0,
//        'model' => $model,
//        'nextPeriod' => 0,
//        'renewLast' => $renewGoals,
//        'block_id' => 0,
//    ]); ?>
<!---->
<!--</div>-->
<?php echo $this->render('/modals/confirm_email',['notifConfEmail' => $notifConfEmail]); ?>

