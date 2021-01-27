<?php
/**
 * @var $title - заголовок */

use yii\helpers\Html;


?>

<div class="archive">
    <div class="archive__list">
        <div class="archive__header">
            <div class="archive__numb">№ п/п</div>
            <div class="archive__date">Дата</div>
            <div class="archive__status">Статус куратора</div>
            <div class="archive__done">Выполнено дел</div>
        </div>
        <?php
        if ($reports) {
            foreach ($reports as $key => $report) {
                echo \app\widgets\tasks\ArchiveListOneTaskWidget::widget([
                    'number' => $key + 1,
                    'report' => $report,
                    'finishedTasksCount' => $tasksCountReports[$report->date]['finishedCount'],
                    'tasksCount' => $tasksCountReports[$report->date]['totalCount'],
                ]);
            }
        } else {
            echo '<p>Задачи отсутствовали.</p>';
        }
        ?>
    </div>
    <div class="calendar" id="calendar_block"></div>
</div>
