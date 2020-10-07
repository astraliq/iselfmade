<?php

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this \yii\web\View */
/* @var $model \app\models\User */
?>

<div class="row">
    <div class="col-md-6">
        <h3>Регистрация</h3>
        <?php $form=\yii\bootstrap\ActiveForm::begin(); ?>
        <?=$form->field($model,'email');?>
        <?=$form->field($model,'password')->passwordInput();?>
        <?=$form->field($model,'repeat_password')->passwordInput();?>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Зарегистрироваться</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end();?>
    </div>
</div>
