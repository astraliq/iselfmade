<?php

/* @var $this \yii\web\View */
/* @var $content string */

$this->title = 'iselfmade.ru';

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
\app\assets\AuthAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="header__style">
    <a href="/" class="header__logo-link">
        <p class="header__logo header__logo_black">i<span class="header__logo header__logo_blue">self</span>made.ru</p>
    </a>
    <div class="header__items">
        <div class="header__item">
            <a href="/" class="header__menu header__menu-active">О системе</a>
        </div>
        <div class="header__item">
            <a href="/" class="header__menu header__menu-link">Частые вопросы</a>
        </div>
        <div class="header__item">
            <a href="/" class="header__menu header__menu-link">Тарифы</a>
        </div>
        <div class="header__item" id="premodal">
            <button class="header__btn" id="login">Вход/Регистрация</button>
        </div>
    </div>
</header>

<div class="container">
    <div class="modal invisible" id="modal">
        <div class="modal__close" id="close">×</div>

        <div class="modal__style" id="mwindow-login">
            <p class="modal__title">Вход в систему</p>

            <?php $form=\yii\bootstrap\ActiveForm::begin([
                'validateOnBlur' => false,
                'validateOnChange' => true,
                'enableAjaxValidation' => true,
//                    'enableClientValidation' => true,
//                    'validationUrl' => '/auth/validate-sign-in',
                'action' => '/auth/sign-in',
                'options' => [
                    'id' => 'form-login',
                    'class' => 'modal__form'
                ]
            ]); ?>
            <?=$form->field($this->params['model'],'email',['validateOnChange' => false])->textInput(['class' => 'modal__input', 'id' => 'login-user-email'])->error(false)?>
            <?=$form->field($this->params['model'],'password')->passwordInput(['class' => 'modal__input', 'id' => 'login-user-password'])?>
            <div class="modal__sub">
                <button type="submit" class="modal__btn">Войти</button>
                <a class="modal__link" id="remind">Напомнить пароль</a>
            </div>
            <?php \yii\bootstrap\ActiveForm::end();?>

            <div class="div_center">
                <button class="modal__reg modal__reg_white" id="regbtn">Зарегистрироваться</button>
            </div>
        </div>

        <div class="modal__style invisible" id="mwindow-remind">
            <p class="modal__title">Напомнить пароль</p>
            <form class="modal__form-remind">
                <input class="modal__input" name="User[email]" type="text" placeholder="Email" aria-required="true">
                <div class="modal__sub">
                    <button class="modal__btn">Напомнить</button>
                </div>
            </form>
            <div class="div_center">
                <button class="modal__reg modal__reg_white loginbtn">Войти</button>
            </div>
        </div>

        <div class="modal__style invisible" id="mwindow-reg">
            <p class="modal__title">Регистрация</p>

            <?php $form=\yii\bootstrap\ActiveForm::begin([
                'validateOnChange' => true,
                'enableAjaxValidation' => true,
                'action' => '/auth/sign-up',
                'options' => [
                    'id' => 'form-reg',
                    'class' => 'modal__form-sign_up'
                ]
            ]); ?>
            <?=$form->field($this->params['model'],'email')->textInput(['class' => 'modal__input', 'id' => 'reg-user-email']);?>
            <?=$form->field($this->params['model'],'password')->passwordInput(['class' => 'modal__input', 'id' => 'reg-user-password'])?>
            <?=$form->field($this->params['model'],'repeat_password')->passwordInput(['class' => 'modal__input', 'id' => 'reg-user-repeat_password']);?>
            <?= $form->errorSummary($this->params['model'],['header' => '', 'class' => 'has-error']); ?>
            <p class="modal__sign-text">Нажимая на кнопку, вы соглашаетесь с <a class="modal__sign-text_link" href="#">нашими правилами</a>
                и <a class="modal__sign-text_link" href="#">политикой конфиденциальности</a></p>
            <div class="modal__sub">
                <button type="submit" class="modal__btn modal__btn-sign">Зарегистрироваться</button>
            </div>
            <?php \yii\bootstrap\ActiveForm::end();?>

            <div class="div_center">
                <button class="modal__reg modal__reg_white loginbtn">Войти</button>
            </div>
        </div>
    </div>
    <?= $content ?>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name . ' ' . date('Y') ?></p>
        <p class="pull-right"> Разработано PlanB </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
