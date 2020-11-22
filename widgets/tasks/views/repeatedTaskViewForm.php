<?php

use yii\helpers\Html;


?>
<div class="user_profile">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'options' => ['class' => 'profile_form', 'enctype' => 'multipart/form-data'],
    ]);  ?>
    <?=$form->field($task,'task')->textInput(['readOnly' => true])->label(false);?>
    <?=$form->field($task,'repeat_type_id')->dropDownList($task::TASK_PRIVATE, ['options' => [ $task->repeat_type_id => ['Selected' => true]]])->label(false);?>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
