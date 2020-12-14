<?php

/* @var $this yii\web\View */

$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];

use yii\helpers\Html;

?>

<div class="tasks-form">
    <div class="tasks-all">
        <?= \app\widgets\tasks\TasksViewWidget::widget([
            'title' => 'Цели на год',
            'tasks' => $goals,
            'del' => false,
            'type_id' => 3,
            'model' => $model,
            'nextPeriod' => 0,
            'renewLast' => $renewGoals,
            'block_id' => 4,
        ]); ?>
        <?= \app\widgets\tasks\TasksViewWidget::widget([
            'title' => 'Задачи на '. $month ,
            'tasks' => $aims,
            'del' => false,
            'type_id' => 2,
            'model' => $model,
            'nextPeriod' => 0,
            'renewLast' => $renewAims,
            'block_id' => 3,
        ]); ?>
        <?= \app\widgets\tasks\TasksViewWidget::widget([
            'title' => 'Что я сделал сегодня',
            'tasks' => $tasks,
            'del' => false,
            'type_id' => 1,
            'model' => $model,
            'nextPeriod' => 0,
            'renewLast' => $renewTasks,
            'block_id' => 2,
        ]); ?>
        <?= \app\widgets\tasks\TasksViewWidget::widget([
            'title' => 'Что я сделаю завтра',
            'tasks' => $tasksTomorrow,
            'del' => false,
            'type_id' => 1,
            'model' => $model,
            'nextPeriod' => 1,
            'renewLast' => false,
            'block_id' => 1,
        ]); ?>
    </div>

</div>


<?= $this->render('/modals/confirm_email', ['notifConfEmail' => $notifConfEmail]); ?>

