<?php
/**
 * @var $title - заголовок
 * @var $grade - оценка наставника
 * @var $tasks - массив задач
 */

if ($title) {
    $comma = ', ';
} else {
    $comma = '';
}

use yii\helpers\Html;

if ($grade) {
    $gradeText = 'Оценка наставника: ';
} else {
    $grade ='';
}

?>

<div class="archive__list" id="tasks_list-<?=$block_id?>">
    <h4 class="archive_title"><?=Html::encode($title)?><?=$comma?><span class="archive_date"><?=Html::encode($date)?></span></h4>
    <p class="grade_text"><?=$gradeText?><span class="grade_number"><?=$grade?></span></p>
    <ol class="archive__list_items">
        <?php
        if ($tasks) {
            foreach ($tasks as $task) {
                echo \app\widgets\tasks\ArchiveOneTaskWidget::widget([
                    'task' => $task,
                ]);
            }
        } else {
            echo '<p class="no_data">Задачи отсутствовали.</p>';
        }
        ?>
    </ol>

</div>