<?php

/* @var $this yii\web\View */

$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];

use yii\helpers\Html;
\app\assets\ReportsAsset::register($this);



if ($userReport) {
    $disabled = 'disabled';
    $disabled_text = 'disabled_text';
    $placeHolder = '';
    $dragDrop = '';
    $disableTasks = true;
    $uploadedFiles = explode('/', $userReport->files);
    if ($userReport->files) {
        foreach ($uploadedFiles as $file) {
            $files .= '<img class="input_img" src="/users/report_files/' . $userId . '/' . $file . '" alt="' . $file . '" title="' . $file . '" data-name="' . $file . '">';
        };
    } else {
        $files = 'файлы не прикреплены';
    }
    $comment = $userReport->comment ? $userReport->comment : 'не указано';

} else {
    $disabled = '';
    $disabled_text = '';
    $placeHolder = 'Это никак не влияет на вашу статистику или эффективность. Это ещё одна возможность посмотреть на себя со стороны и лучше понимать что происходит в вашей жизни.';
    $dragDrop = '<div class="drag_drop" id="drag_drop" style="display: none">Перетащите файлы сюда</div>';
    $disableTasks = false;
    $files = 'Ничего не выбрано';
}
if ($userReport->self_grade) {
    $repeatTypeSelect[$userReport->self_grade] = 'selected';
} else {
    $repeatTypeSelect[0] = 'selected';
}



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
            'disabled' => false,
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
            'disabled' => false,
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
            'disabled' => $disableTasks,
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
            'disabled' => false,
        ]); ?>
    </div>
    <form enctype="multipart/form-data" method="post" name="report_data" id="report_data" class="report_data">
        <div id="user_id" style="display: none" data-user_id="<?=$userId?>"></div>
        <?=$dragDrop?>
        <section class="files">
            <p class="title <?=$disabled_text?>">Загрузить файлы <span class="show-end">(по необходимости)</span></p>
            <div class="field__wrapper">
                <input name="file" type="file" id="files_input" class="field field__file" multiple accept="image/jpeg,image/png,audio/mpeg3,audio/x-mpeg-3" <?=$disabled?>>
                <label class="field__file-wrapper" for="files_input">
                    <div class="field__file-fake <?=$disabled?>" id="file_list" data-userid="<?=$userId?>"><?=$files?></div>

                    <div class="field__file-button <?=$disabled?>">Выбрать</div>
                </label>
            </div>
        </section>
        <section class="impress">
            <p class="title <?=$disabled_text?>">Общее впечатление дня</p>
            <textarea name="text" type="text" class="impress__text" placeholder="<?=$placeHolder?>" id="user_comment" <?=$disabled?>><?=$comment?></textarea>
        </section>
        <section class="day-rating" id="allstars">
            <p class="title <?=$disabled_text?>">Личная оценка дня</p>
            <div class="estimation">
                <select name="grade" class="estimation__items"  id="day_rating" <?=$disabled?>>
                    <option class="estimation__item" value="0" <?=$repeatTypeSelect[0]?>>Каким был этот день?</option>
                    <option class="estimation__item" value="1" <?=$repeatTypeSelect[1]?>>1&nbsp;&#151;&nbsp;Никаким</option>
                    <option class="estimation__item" value="2" <?=$repeatTypeSelect[2]?>>2&nbsp;&#151;&nbsp;Ужасным</option>
                    <option class="estimation__item" value="3" <?=$repeatTypeSelect[3]?>>3&nbsp;&#151;&nbsp;Сложным</option>
                    <option class="estimation__item" value="4" <?=$repeatTypeSelect[4]?>>4&nbsp;&#151;&nbsp;Малоэффективным</option>
                    <option class="estimation__item" value="5" <?=$repeatTypeSelect[5]?>>5&nbsp;&#151;&nbsp;Простым</option>
                    <option class="estimation__item" value="6" <?=$repeatTypeSelect[6]?>>6&nbsp;&#151;&nbsp;Так себе</option>
                    <option class="estimation__item" value="7" <?=$repeatTypeSelect[7]?>>7&nbsp;&#151;&nbsp;Нормальным</option>
                    <option class="estimation__item" value="8" <?=$repeatTypeSelect[8]?>>8&nbsp;&#151;&nbsp;С хорошим результатом</option>
                    <option class="estimation__item" value="9" <?=$repeatTypeSelect[9]?>>9&nbsp;&#151;&nbsp;Эффективным</option>
                    <option class="estimation__item" value="10" <?=$repeatTypeSelect[10]?>>10&nbsp;&#151;&nbsp;Супер продуктивным</option>
                </select>
            </div>
        </section>
        <button class="final__btn btn__shadow" id="sendreport" <?=$disabled?>>Отправить отчёт</button>
    </form>

    <?php
    if ($comments) {
        echo \app\widgets\comments\CommentsWidget::widget(
            [
                'comments' => $comments,
                'self' => $self,
                'report' => $userReport,
            ]
        );
    }
    ?>
</div>



<?= $this->render('/modals/confirm_email', ['notifConfEmail' => $notifConfEmail]); ?>

