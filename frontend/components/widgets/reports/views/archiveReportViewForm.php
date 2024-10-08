<?php

/* @var $this \yii\web\View */
/* @var $report  */
/* @var $tasks  */
/* @var $date  */
/* @var $grade  */
$files = '';

if ($report && $report->files) {
    $uploadedFiles = explode('/', $report->files);
    foreach ($uploadedFiles as $file) {
        $files .= '<img class="input_img" src="/users/report_files/' . $self->id . '/' . $file . '" alt="' . $file . '" title="' . $file . '" data-name="' . $file . '" data-user_id="' . $userId . '">';
    };
}

?>
<div class="archive__block" id="archive_block">
    <div class="tasks-form">
        <div class="tasks-all">
            <?= \frontend\components\widgets\tasks\ArchiveTasksWidget::widget([
                'title' => $title,
                'date' => $date,
                'tasks' => $tasks,
                'grade' => $grade,
                'block_id' => 0,
                'comments' => $comments,
                'self' => $self,
                'report' => $report,
            ]); ?>
            <!--        <?//= \frontend\components\widgets\tasks\ArchiveTasksWidget::widget([
            //            'title' => 'Позавчера' ,
            //            'date' => $beforeYesterdayDate,
            //            'tasks' => $beforeYesterday,
            //            'block_id' => 1,
            //        ]); ?>
            -->
        </div>
    </div>
    <?php

    if ($report) {
        echo '<div id="user_id" style="display: none" data-user_id="' . $userId . '"></div>
    <div class="check_uploaded_files" id="check_uploaded_files">' . $files . '</div>
    <p class="check_report_data">Личная оценка дня: ' . $report->self_grade . '</p>
    <p class="check_report_data">Общее впечатление дня: ' . nl2br(\yii\helpers\Html::encode($report->comment)) . '</p>';


        echo \frontend\components\widgets\comments\CommentsWidget::widget([
            'comments' => $comments,
            'self' => $self,
            'report' => $report,
        ]);
    }
    ?>
</div>
