<?php

/* @var $this yii\web\View */

$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];
\app\assets\ReportsAsset::register($this);
use yii\helpers\Html;
?>

<div class="check">
    <h3 class="check-title">проверка отчетов (<span class="count_reports">осталось </span><span class="count_reports" id="count_reports"> <?=$reportsCount?></span>)</h3>
    <?php
    if ($report) {
        echo \app\widgets\tasks\CheckReportsWidget::widget([
            'user' => $user,
            'tasks' => $tasks,
            'block_id' => 0,
            'date' => $date,
            'userReport' => $report,
        ]);
    } else {
        echo '<div class="check-content" id="report_data" data-id="" data-date="">';
        echo '<p>Все отчеты проверены</p>';
        echo '</div>';
    }
    ?>
    <div class="check-buttons">
        <button id="skip_report">Пропустить</button>
        <button id="next_report">Принять отчет</button>
    </div>
</div>
<?php
echo \app\widgets\comments\CommentsWidget::widget([
            'comments' => $comments,
            'self' => $self,
            'report' => $report,
        ]);
?>

<?= $this->render('/modals/confirm_email',['notifConfEmail' => $notifConfEmail]); ?>

