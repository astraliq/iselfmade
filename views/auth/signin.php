<?php

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
?>

<div class="row">
    <div class="col-md-6">
        <h3>Вход</h3>
        <?php $form=\yii\bootstrap\ActiveForm::begin(); ?>
        <?=$form->field($model,'email')->error(false)?>
        <?=$form->field($model,'password')->passwordInput()->error(false)?>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Войти</button>
        </div>
        <?= $form->errorSummary($model,['header' => '', 'class' => 'has-error']); ?>
        <?php \yii\bootstrap\ActiveForm::end();?>
    </div>
</div>
