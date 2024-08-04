<?php

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this \yii\web\View */
/* @var $model \common\models\User */
?>

<div class="restore-block">
    <h3 class="form-name">Восстановление пароля</h3>
    <?php $form=\kartik\form\ActiveForm::begin([
        'validateOnChange' => false,
        'validateOnBlur' => false,
        'enableAjaxValidation' => true,
        'action' => '/auth/restore-password',
        'options' => [
            'id' => 'main-form-restore',
            'class' => 'modal__form-main-restore'
        ]
    ]); ?>
    <?=$form->field($model,'email')->textInput(['class' => 'modal__input', 'id' => 'main-restore-email', 'type' => 'email', 'autocomplete' => 'username'])->hiddenInput(['value' => $email])->label(false);?>
    <?=$form->field($model,'token')->textInput(['class' => 'modal__input', 'id' => 'main-restore-token', 'placeholder' => 'Код подтверждения из письма', 'type' => 'text', 'autocomplete' => 'token']);?>
    <?=$form->field($model,'password')->passwordInput(['class' => 'modal__input', 'id' => 'main-restore-user-password', 'type' => 'password', 'autocomplete' => 'new-password'])->label('Новый парооль')?>
    <?=$form->field($model,'repeat_password')->passwordInput(['class' => 'modal__input', 'id' => 'main-restore-user-repeat_password', 'type' => 'password', 'autocomplete' => 'new-password'])->label('Повтор нового парооля');?>
    <div class="modal__sub">
        <button type="submit" class="modal__btn modal__btn-restore">Готово!</button>
    </div>
    <?php \kartik\form\ActiveForm::end();?>
</div>
