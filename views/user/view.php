<?php
use yii\helpers\Html;
?>

<p>ID пользователя: <?= $user->id ?></p>

<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
//                'enableAjaxValidation' => true,
//                'enableClientValidation' => false,
            'options' => ['enctype' => 'multipart/form-data', 'action' => 'user/update'],
            'action' => '/user/update',
        ]);  ?>
        <?=$form->field($user,'email');?>
        <?=$form->field($user,'name');?>
        <?=$form->field($user,'surname');?>
        <?=$form->field($user,'phone_number')->input('phone');?>
        <?=$form->field($user,'timezone');?>
        <?=$form->field($user,'avaReal')->fileInput();?>
        <?=$form->field($user,'password')->passwordInput();?>
        <?=$form->field($user,'repeat_password')->passwordInput();?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>