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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="header__style_error">
    <div class="header__top">
        <a class="header-logo-link" href="http://iselfmade.ru">
            <div class="header__logo">
                <img src="img/logo.png" width="150" height="auto" alt="НОСОРОГ">
                <p class="header-logo-text">i<span class="header-logo-text-self">self</span>made.ru</p>
            </div>
        </a>
        <h1 class="header__title2">&laquo;НОСОРОГ&raquo; &#151; система достижения целей, помогающая дойти до конца</h1>
<!--        <div class="header__button">-->
<!--            <button class="header__btn btn__shadow" id="login">Вход/Регистрация</button>-->
<!--        </div>-->
    </div>

</header>

<div class="container">
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
