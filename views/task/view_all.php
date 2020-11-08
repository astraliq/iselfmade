<?php

/* @var $this yii\web\View */

$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];

use yii\helpers\Html;

?>

<div class="tasks-form">
<!--    <p><a class="btn btn-lg btn-success" href="/task/create">Создать задачу</a></p>-->
    <div class="tasks-all">
        <?= \app\widgets\tasks\TasksViewWidget::widget([
            'title' => 'Цели на год',
            'tasks' => $goals,
            'del' => false,
            'type_id' => 3,
            'model' => $model,
            'nextPeriod' => 0,
            'renewLast' => $renewGoals,
        ]); ?>
        <?= \app\widgets\tasks\TasksViewWidget::widget([
            'title' => 'Задачи на '. $month ,
            'tasks' => $aims,
            'del' => false,
            'type_id' => 2,
            'model' => $model,
            'nextPeriod' => 0,
            'renewLast' => $renewAims,
        ]); ?>
        <?= \app\widgets\tasks\TasksViewWidget::widget([
            'title' => 'Что я сделал сегодня',
            'tasks' => $tasks,
            'del' => false,
            'type_id' => 1,
            'model' => $model,
            'nextPeriod' => 0,
            'renewLast' => $renewTasks,
        ]); ?>
        <?= \app\widgets\tasks\TasksViewWidget::widget([
            'title' => 'Что я сделаю завтра',
            'tasks' => $tasksTomorrow,
            'del' => false,
            'type_id' => 1,
            'model' => $model,
            'nextPeriod' => 1,
            'renewLast' => false,
        ]); ?>
    </div>
<!--    <div class="tasks-deleted"  style="width: 50%">-->
<!--        --><?//= \app\widgets\tasks\TasksViewWidget::widget([
//            'title' => 'Удаленные',
//            'tasks' => $deleted,
//            'del' => true,
//            'model' => $model,
//        ]); ?>
<!--        <div class="aims__footnotes">-->
<!--            <div class="footnotes__text">Коэффециент выполнения</div>-->
<!--            <div class="footnotes__numbers footnotes__numbers_color-red">62,5%</div>-->
<!--        </div>-->
<!--    </div>-->
</div>

<?php
    if ($notifConfEmail) {
        echo '<div class="email_confirmation">
        <button class="email_confirmation_close">X</button>
        <h4>Подтверждение электронной почты</h4>
        <p>После регистрации на Вашу электронную почту отправлено письмо со ссылкой подтверждения.</p>
        <p>Просим Вас в ближайшее время подтвердить электронную почту для полноценного использования сервиса.</p>
        <p>Если Вам по какой-либо причине не пришло письмо со ссылкой подтверждения, то нажмите на кнопку:</p>
        <button class="btn_conf_email">Отправить письмо</button>
    </div>';
    }

?>

