<?php


?>



<div class="row">
    <div class="col-md-6">
        <h3>Добавить задачу</h3>
        <?php $form=\yii\bootstrap\ActiveForm::begin(); ?>
        <?=$form->field($model,'type_id',['enableClientValidation'=>false, 'enableAjaxValidation'=>true])->dropDownList($model::TYPE_TASK,['options' =>[ '1' => ['Selected' => true]]]);?>
        <?=$form->field($model,'task')->textarea();?>
<!--        --><?//=$form->field($model,'date_calculate')->input('date', ['value' => $model->date_calculate])?>
        <?=$form->field($model,'private_id',['enableClientValidation'=>false, 'enableAjaxValidation'=>true])->dropDownList($model::TASK_PRIVATE,['options' =>[ '1' => ['Selected' => true]]]);?>
        <?=$form->field($model,'aim_id',['enableClientValidation'=>false, 'enableAjaxValidation'=>true])->dropDownList($aims,['prompt' =>'']);?>
        <?=$form->field($model,'goal_id',['enableClientValidation'=>false, 'enableAjaxValidation'=>true])->dropDownList($goals,['prompt' =>'']);?>
        <div class="form-group">
            <?php
                if ($action === 'create') {
                    echo '<button type="submit" class="btn btn-default">Добавить</button>';
                } elseif ($action === 'change') {
                    echo '<button type="submit" class="btn btn-default">Изменить</button>';
                }
            ?>
        </div>
        <?php \yii\bootstrap\ActiveForm::end();?>
    </div>
</div>
