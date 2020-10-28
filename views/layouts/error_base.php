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
