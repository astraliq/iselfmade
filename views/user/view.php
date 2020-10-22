<?php
use yii\helpers\Html;
?>

<!--<h4 class="user_profile-email">--><?//=$user->email?><!--</h4>-->
<div class="row">
    <div class="user_profile col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
            'options' => ['enctype' => 'multipart/form-data'],
        ]);  ?>
        <?=$form->field($user,'email')->textInput(['readOnly' => true]);?>
        <?=$form->field($user,'name');?>
        <?=$form->field($user,'surname');?>
        <?=$form->field($user,'birthday')->input('date');?>
        <?=$form->field($user,'sex')->dropDownList($user::SEX, ['options' =>[ '1' => ['Selected' => true]]]);?>
        <?=$form->field($user,'phone_number')->input('phone');?>
        <?=$form->field($user,'timezone');?>
        <?=$form->field($user,'avaReal')->fileInput(['multiple' => false,]);?>
        <div class="user_profile-psw">
            <?=$form->field($user,'password',['enableClientValidation'=>false])->passwordInput();?>
            <?=$form->field($user,'repeat_password',['enableClientValidation'=>false])->passwordInput();?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>