<?php
use yii\helpers\Html;

if ($user->mentor_email_confirm != 1) {
    $confirmCuratorBtnClass = '';
    $confirmCuratorClass = 'failure_icon';
} else {
    $confirmCuratorBtnClass = 'hidden_block';
    $confirmCuratorClass = 'success_icon';
}

if ($user->mentor_access_token != null) {
    $confirmCuratorBtnClass = 'hidden_block';
}

if (!$user->mentor_email) {
    $confirmCuratorBtnClass = 'hidden_block';
    $confirmCuratorClass = '';
}

?>

<section class="welcome">
    <h1 class="welcome__title">Наставник</h1>
    <p class="welcome__chapter"></p>
    <p class="welcome__text">Наставник — это уважаемый тобою лично человек. Это может быть кто угодно: супруг/супруга, близкий друг, твой учитель или просто хороший знакомый. Главное — тебе должно быть очень стыдно перед ним облажаться и не выполнить свои дела, ведь он об этом узнает. Это самый главный критерий.</p>
    <p class="welcome__text">Тебе нужно указать его почту и то, как часто он будет получать отчёт о твоей эффективности (каждый день или раз в неделю).</p>
    <p class="welcome__text">После того, как ты это укажешь, ему придёт письмо для подтверждения. Так что предупреди его заранее и спроси разрешения.</p>
    <p class="welcome__text">И выполняй всё, что записано в твоём плане — не расстраивай своего Наставника.</p>
</section>


<div class="row">
    <div class="user_profile">
        <?php $form = \kartik\form\ActiveForm::begin([
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
            'options' => ['class' => 'profile_form', 'enctype' => 'multipart/form-data'],
        ]);?>
        <div class="user_profile-curator">
            <?=$form->field($user,'mentor_email')->input('text',['class' => 'form-control curators_emails']);?>
            <span class="<?=$confirmCuratorClass?>" id="curators_emails_confirm"></span>
            <button class="<?=$confirmCuratorBtnClass?>" id="curators_emails_btn_conf" <?=$confirmCuratorBtnActive ?? null?>>Подтвердить</button>
            <?=$form->field($user,'mentor_email_repeat')->dropDownList($user::REPEAT_CURATOR, ['options' => [ '1' => ['Selected' => true]], 'autocomplete' => 'sex']);?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
        </div>
        <?php \kartik\form\ActiveForm::end(); ?>
    </div>
</div>

<?php echo $this->render('/modals/confirm_email', ['notifConfEmail' => $notifConfEmail]); ?>
<?php echo $this->render('/modals/confirm_curators_email'); ?>