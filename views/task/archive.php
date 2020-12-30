<?php

/* @var $this yii\web\View */

$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];

use yii\helpers\Html;

?>

<div class="tasks-form">
    <div class="tasks-all">
        <?= \app\widgets\tasks\ArchiveTasksWidget::widget([
            'title' => 'Вчера',
            'date' => $yesterdayDate,
            'tasks' => $yesterday,
            'grade' => $yesterdayGrade,
            'block_id' => 0,
        ]); ?>
<!--        --><?//= \app\widgets\tasks\ArchiveTasksWidget::widget([
//            'title' => 'Позавчера' ,
//            'date' => $beforeYesterdayDate,
//            'tasks' => $beforeYesterday,
//            'block_id' => 1,
//        ]); ?>
    </div>
</div>
<div class="calendar" id="calendar_block"></div>

<?= $this->render('/modals/confirm_email',['notifConfEmail' => $notifConfEmail]); ?>

