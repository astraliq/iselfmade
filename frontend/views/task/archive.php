<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
\frontend\assets\ReportsAsset::register($this);
?>
<section class="welcome">
    <h1 class="welcome__title">Прошлые отчёты</h1>
</section>

<?= \app\widgets\tasks\ArchiveTasksListWidget::widget([
    'reports' => $reports,
    'tasksCountReports' => $tasksCountReports,
]); ?>

<?= \app\widgets\reports\ArchiveReportWidget::widget([
        'title' => $title,
        'report' => $yesterdayReport,
        'date' => $yesterdayDate,
        'tasks' => $yesterdayTasks,
        'grade' => $yesterdayGrade,
        'self' => $self,
        'comments' => $comments,
])
    ?>


<?= $this->render('/modals/confirm_email',['notifConfEmail' => $notifConfEmail]); ?>

