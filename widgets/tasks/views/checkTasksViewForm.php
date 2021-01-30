<?php
/**
 * @var $title - заголовок */

use yii\helpers\Html;
$files = '';
if ($userReport->files) {
    $uploadedFiles = explode('/', $userReport->files);
    foreach ($uploadedFiles as $file) {
        $files .= '<img class="input_img" src="/users/report_files/' . $user->id . '/' . $file . '" alt="' . $file . '" title="' . $file . '" data-name="' . $file . '">';
    };
} else {
    $files = '';
}

?>
<div class="check-content" id="report_data" data-id="<?=$user->id?>" data-date="<?=$date?>">
    <div class="check-user_data">
        <h3>Данные пользователя:</h3>
        <table>
            <tr>
                <td class="check-user_data-options">ID:</td>
                <td class="check-user_data-data"><?=$user->id?></td>
            </tr>
            <tr>
                <td class="check-user_data-options">Имя:</td>
                <td class="check-user_data-data"><?=Html::encode($user->name)?></td>
            </tr>
            <tr>
                <td class="check-user_data-options">Фамилия:</td>
                <td class="check-user_data-data"><?=Html::encode($user->surname)?></td>
            </tr>
            <tr>
                <td class="check-user_data-options">День рождения:</td>
                <td class="check-user_data-data"><?=(new \DateTime($user->birthday))->format('d.m.Y')?></td>
            </tr>
            <tr>
                <td class="check-user_data-options">Телефон:</td>
                <td class="check-user_data-data"><?=$user->phone_number?></td>
            </tr>
        </table>
    </div>
<!--    <button class="check-chat_btn" id="chat" data-id="--><?//=$user->id?><!--">Открыть комментарии</button>-->

    <div class="tasks-form">
        <div class="tasks-all">
            <?= \app\widgets\tasks\ArchiveTasksWidget::widget([
                'title' => '',
                'date' => $date,
                'tasks' => $tasks,
                'grade' => 0,
                'block_id' => 0,
            ]); ?>
        </div>
    </div>
    <div id="user_id" style="display: none" data-user_id="<?=$user->id?>"></div>
    <div class="check_uploaded_files" id="check_uploaded_files"><?=$files?></div>
    <p class="check_report_data">Личная оценка дня: <?=$userReport->self_grade?></p>
    <p class="check_report_data">Общее впечатление дня: <?=nl2br(Html::encode($userReport->comment))?></p>
    <!--    <div class="check-grades">-->
    <!--        <p>Оценить отчет:</p>-->
    <!--        <input type="radio" id="grade1" name="report_grade" value="1">-->
    <!--        <label for="grade1">1</label>-->
    <!--        <input type="radio" id="grade2" name="report_grade" value="2">-->
    <!--        <label for="grade2">2</label>-->
    <!--        <input type="radio" id="grade3" name="report_grade" value="3">-->
    <!--        <label for="grade3">3</label>-->
    <!--        <input type="radio" id="grade4" name="report_grade" value="4">-->
    <!--        <label for="grade4">4</label>-->
    <!--        <input type="radio" id="grade5" name="report_grade" value="5">-->
    <!--        <label for="grade5">5</label>-->
    <!--    </div>-->
</div>


