<?php

/* @var $this yii\web\View */

$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];
\frontend\assets\ReportsAsset::register($this);
use yii\helpers\Html;
?>

<div class="check">
    <h3 class="check-title">проверка отчетов (<span class="count_reports">осталось </span><span class="count_reports" id="count_reports"> <?=$reportsCount?></span>)</h3>
    <?php
    if ($report) {
        echo \frontend\components\widgets\tasks\CheckReportsWidget::widget([
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
    if ($report->status < 4) {
        echo '<div class="check-buttons">
        <button id="reject_report">Отклонить</button>
        <button id="skip_report">Пропустить (следующий)</button>
        <button id="next_report">Принять отчет</button>
    </div>';
    } else {
        echo '<p class="report_success">Отчет принят</p>';
    }

    ?>
</div>
<?php

if ($report) {
    echo \frontend\components\widgets\comments\CommentsWidget::widget(
        [
            'comments' => $comments,
            'self' => $self,
            'report' => $report,
        ]
    );
}
?>

<?= $this->render('/modals/confirm_email',['notifConfEmail' => $notifConfEmail]); ?>

