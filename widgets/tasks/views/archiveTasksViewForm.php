<?php
/**
 * @var $title - заголовок */

if ($title) {
    $comma = ', ';
} else {
    $comma = '';
}

use yii\helpers\Html;
?>

<div class="archive__list" id="archive-<?=$block_id?>">
    <h4 class="archive_title"><?=Html::encode($title)?><?=$comma?><span class="archive_date"><?=Html::encode($date)?></span></h4>
    <ol class="archive__list_items">
        <?php
        if ($tasks) {
            foreach ($tasks as $task) {
                echo \app\widgets\tasks\ArchiveOneTaskWidget::widget([
                    'task' => $task,
                ]);
            }
        } else {
            echo '<p>Задачи отсутствовали.</p>';
        }
        ?>
    </ol>
</div>