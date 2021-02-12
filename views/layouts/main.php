<?php

/* @var $this \yii\web\View */
/* @var $content string */

$this->title = 'НОСОРОГ&nbsp;&#151;&nbsp;достигаю целей';

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
<!--
НОСОРОГ — система достижения целей
                              ¶¶¶1
                           1¶¶¶¶¶¶¶  1¶¶        1
                    1¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶         ¶
        1¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶    1   ¶¶
     1¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶11¶¶  ¶¶¶
    ¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶1¶¶¶1
   ¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
  ¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
  ¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
 ¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
 ¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶      1¶¶¶¶¶¶¶
 1¶¶¶¶11¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶1
 1¶¶¶¶ ¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶  ¶¶¶¶1
 ¶¶¶¶  ¶¶¶          ¶¶¶1  ¶¶¶¶
 1¶¶   ¶¶¶          ¶¶¶1  ¶¶¶1
  ¶¶¶  ¶¶¶¶         ¶¶¶   ¶¶¶
 1¶¶¶1  111         ¶¶¶1  ¶¶¶¶¶
                    ¶¶¶¶¶ 1¶¶¶¶
http://iselfmade.ru
-->
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="noyaca" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="og:site_name" content="iselfmade.ru" />
    <meta property="fb:app_id" content="819344165587129" />
    <meta property="vk:image" content="img/covers/cover-vk.png">
    <meta property="twitter:image" content="img/covers/cover-og.png" />
    <meta property="og:image" content="img/covers/cover-og.png" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:title" content="НОСОРОГ &#151; твой волшебный «пендель»." />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="НОСОРОГ — твой волшебный «пендель»." />
    <meta name="description" content="НОСОРОГ &#151; твой волшебный «пендель». Заходи и сделай то, что планируешь уже давно." />
    <link rel="image_src" href="img/covers/cover-og.png">
    <meta property="og:url" content="https://iselfmade.ru/" />
    <link rel="canonical" href="https://iselfmade.ru/">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">

    <meta name="twitter:card" content="summary_large_image" />

    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="icon" type="image/png" href="apple-touch-icon-180x180.png">
    <link rel="apple-touch-icon" href="apple-touch-icon-180x180.png">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#E25A76">

    <meta name="msapplication-tile-image" content="favicons/mstile-150x150.png">

    <meta name="theme-color" content="#3876D2">
    <meta name="msapplication-navbutton-color" content="#3876D2">
    <meta name="apple-mobile-web-app-status-bar-style" content="#3876D2">


<!--    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap" rel="stylesheet">-->
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="header__style">
    <div class="header__top">
        <a class="header-logo-link" href="http://iselfmade.ru">
            <div class="header__logo">
                <img src="img/logo.png" width="150" height="auto" alt="НОСОРОГ">
                <p class="header-logo-text">i<span class="header-logo-text-self">self</span>made.ru</p>
            </div>
        </a>
        <div class="header__button">
            <button class="header__btn btn__shadow" id="login">Вход/Регистрация</button>
        </div>
    </div>
    <h1 class="header__title">&laquo;НОСОРОГ&raquo; &#151; система достижения целей, помогающая дойти&nbspдо&nbspконца</h1>
    <p class="header__text">
        Наша задача сделать так, чтобы завтра вы <strong>сделали</strong> то, <strong>что запланировали</strong>, находясь в ситуации, когда <span class="header__text_color-blue">проще сделать, чем не сделать</span>.</p>
    <p class="header__text padding-top_20">И так каждый день.</p>
    <p class="header__text">Пока не достигните цели.</p>
</header>

<div class="container">
    <div class="modal hide_modal d-none" id="modal">
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
            <?=$form->field($this->params['signIn'],'email',['validateOnChange' => false])->textInput(['class' => 'modal__input', 'id' => 'login-user-email', 'type' => 'email', 'autocomplete' => 'username'])->error(false)?>
            <?=$form->field($this->params['signIn'],'password')->passwordInput(['class' => 'modal__input', 'id' => 'login-user-password', 'type' => 'password', 'autocomplete' => 'current-password'])?>
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
            <p class="modal__title">Восстановление пароля</p>
            <?php $form=\yii\bootstrap\ActiveForm::begin([
                'validateOnChange' => false,
                'validateOnBlur' => false,
                'enableAjaxValidation' => true,
                'validationUrl' => '/auth/validate-remind-password',
                'action' => '/auth/remind-password',
                'options' => [
                    'id' => 'form-remind',
                    'class' => 'modal__form-remind'
                ]
            ]); ?>
            <?=$form->field($this->params['signUp'],'email')->textInput(['class' => 'modal__input', 'id' => 'remind-user-email', 'type' => 'email', 'autocomplete' => 'username']);?>
            <div class="modal__sub">
                <button type="submit" class="modal__btn modal__btn-restore">Отправить</button>
            </div>
            <?php \yii\bootstrap\ActiveForm::end();?>

            <div class="div_center">
                <button class="modal__reg modal__reg_white loginbtn">Войти</button>
            </div>
        </div>

        <div class="modal__style invisible" id="mwindow-restore">
            <p class="modal__title">Восстановление пароля</p>
            <?php $form=\yii\bootstrap\ActiveForm::begin([
                'validateOnChange' => false,
                'validateOnBlur' => false,
                'enableAjaxValidation' => true,
                'action' => '/auth/restore-password',
                'options' => [
                    'id' => 'form-restore',
                    'class' => 'modal__form-restore'
                ]
            ]); ?>
            <?=$form->field($this->params['restoreModel'],'email')->textInput(['class' => 'modal__input', 'id' => 'restore-email', 'type' => 'email', 'autocomplete' => 'username'])->hiddenInput()->label(false);?>
            <?=$form->field($this->params['restoreModel'],'token')->textInput(['class' => 'modal__input', 'id' => 'restore-token', 'placeholder' => 'Код подтверждения из письма','type' => 'text', 'autocomplete' => 'token']);?>
            <?=$form->field($this->params['restoreModel'],'password')->passwordInput(['class' => 'modal__input', 'id' => 'restore-user-password', 'type' => 'password', 'autocomplete' => 'new-password'])->label('Новый пароль')?>
            <?=$form->field($this->params['restoreModel'],'repeat_password')->passwordInput(['class' => 'modal__input', 'id' => 'restore-user-repeat_password', 'type' => 'password', 'autocomplete' => 'new-password'])->label('Повтор нового пароля');?>
            <div class="modal__sub">
                <button type="submit" class="modal__btn modal__btn-restore">Готово!</button>
            </div>
            <?php \yii\bootstrap\ActiveForm::end();?>
            <div class="div_center">
                <button class="modal__reg modal__reg_white loginbtn">Войти</button>
            </div>
        </div>

        <div class="modal__style invisible" id="mwindow-reg">
            <p class="modal__title">Регистрация</p>

            <?php $form=\yii\bootstrap\ActiveForm::begin([
                'validateOnChange' => false,
                'enableAjaxValidation' => true,
                'action' => '/auth/sign-up',
                'options' => [
                    'id' => 'form-reg',
                    'class' => 'modal__form-sign_up'
                ]
            ]); ?>
            <?=$form->field($this->params['signUp'],'email',['validateOnChange' => true])->textInput(['class' => 'modal__input', 'id' => 'reg-user-email', 'type' => 'email', 'autocomplete' => 'username']);?>
            <?=$form->field($this->params['signUp'],'password')->passwordInput(['class' => 'modal__input', 'id' => 'reg-user-password', 'type' => 'password', 'autocomplete' => 'new-password'])?>
            <?=$form->field($this->params['signUp'],'repeat_password')->passwordInput(['class' => 'modal__input', 'id' => 'reg-user-repeat_password', 'type' => 'password', 'autocomplete' => 'new-password']);?>
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

<footer class="footer__style">
    <div class="footer__logo">
        <img src="img/rhino-footer.png" width="100" height="50" alt="Проще сделать, чем не сделать">
        <p class="footer__logo-text-1">ПРОЩЕ</p>
        <p class="footer__logo-text-2">СДЕЛАТЬ,</p>
        <p class="footer__logo-text-3">ЧЕМ</p>
        <p class="footer__logo-text-4">НЕ СДЕЛАТЬ</p>
    </div>
    <div class="footer__soc">
        <p class="footer__soc-title">Следи за нами</p>
        <a class="footer__soc-text" href="https://vk.com/iselfmaderu">Вконтакте</a>
        <a class="footer__soc-text" href="https://www.instagram.com/iselfmade.ru/">Инстаграм</a>
        <a class="footer__soc-text" href="https://t.me/iselfmaderu">Телеграм&#150;канал</a>
    </div>
    <div class="footer__sub">
        <p class="footer__sub-text">Полезная еженедельная рассылка</p>
        <div class="footer__form">
            <input class="footer__input" type="text" placeholder="email">
            <button class="footer__btn">Подписаться</button>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php


?>
