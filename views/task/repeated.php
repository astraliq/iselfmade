<?php

/* @var $this yii\web\View */


use yii\helpers\Html;

?>
<section class="welcome">
    <h1 class="welcome__title">Повторяющиеся дела</h1>
    <p class="welcome__text">Если у тебя есть дело, которое ты выполняешь регулярно, то запиши его тут. Частота выполнений может быть разная, мы учли все возможные варианты.</p>
    <p class="welcome__text">
        После того, как ты добавишь повторяющееся дело, в нужный день оно будет включено в твой список дел на завтра (&laquo;Что я сделаю завтра&raquo;) и ты не пропустишь его.
    </p>
</section>

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
            echo \app\widgets\tasks\OneTaskViewWidget::widget(
                [
                    'task' => '',
                    'type_id' => $type_id,
                    'nextPeriod' => $nextPeriod,
                    'newTask' => 1,
                    'repeatedTask' => false,
                    'disabled' => $disabled,
                ]
            );
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

