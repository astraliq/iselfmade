<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
$this->title = 'НОСОРОГ&nbsp;&#151;&nbsp;достигаю целей';
AppAsset::register($this);

$avatarImage = \Yii::$app->user->getIdentity()->getAvatarName();
if (!$avatarImage) {
    $avatarImage = '/img/user_img.jpg';
} else {
    $avatarImage = '/users/ava/' . $avatarImage;
}
$mentorCan = \Yii::$app->user->can('curator');
$userRole = current(\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->getId()))->name;
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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container">
    <div class="custom_light">
        <div class="">
            <img class="user_img" src="<?= Html::encode($avatarImage) ?>" width="60" height="60">
        </div>
    </div>
    <div class="menu">
        <div class="date">
            <span class="date__day"><?php echo date('d') ?></span>
            <span class="date__month">.<?php echo date('m') ?></span>
            <p class="date__weekday"><?php echo \Yii::$app->formatter->asDate(date('Y-m-d'), 'php: l')?></p>
        </div>
        <div class="menu__list">
            <?php
            $url = \Yii::$app->request->url;
            echo Nav::widget([
                'options' => ['class' => 'menu__items'],
                'items' => [
                    (['label' => 'Отчет',
                        'url' => ['/report'],
                        'options' => ['class' => $url=='/report' ? 'main_menu-selected' : ''],
                        'linkOptions' => ['class' => 'menu__item'],
                    ]),
                    (['label' => 'Мои обещания',
                        'url' => ['/promises'],
                        'options' => ['class' => $url=='/promises' ? 'main_menu-selected' : ''],
                        'linkOptions' => ['class' => 'menu__item'],
                    ]),
//                    (['label' => 'Статистика',
//                        'url' => ['/statistics'],
//                        'options' => ['class' => $url=='/statistics' ? 'main_menu-selected' : ''],
//                        'linkOptions' => ['class' => 'menu__item'],
//                    ]),
//                    (['label' => 'Категории',
//                        'url' => ['/category'],
//                        'options' => ['class' => $url=='/category' ? 'main_menu-selected' : ''],
//                        'linkOptions' => ['class' => 'menu__item'],
//                    ]),
                    (['label' => 'Повторяющиеся задачи',
                        'url' => ['/repeated'],
                        'options' => ['class' => $url=='/repeats' ? 'main_menu-selected' : ''],
                        'linkOptions' => ['class' => 'menu__item'],
                    ]),
                    (['label' => 'Архив отчетов',
                        'url' => ['/archive'],
                        'options' => ['class' => $url=='/archive' ? 'main_menu-selected' : ''],
                        'linkOptions' => ['class' => 'menu__item'],
                    ]),
                    (['label' => 'Личный кабинет',
                        'url' => ['/profile'],
                        'options' => ['class' => $url=='/profile' ? 'main_menu-selected' : ''],
                        'linkOptions' => ['class' => 'menu__item'],
                    ]),
                    $mentorCan ? ((['label' => 'Проверка отчетов',
                        'url' => ['/check-reports'],
                        'options' => ['class' => $url=='/check-reports' ? 'main_menu-selected' : ''],
                        'linkOptions' => ['class' => 'menu__item'],
                    ])) : (''),
                    (
                        '<li class="menu__logout">'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Выход (' . Yii::$app->user->identity->email . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    ),
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="main__data">
        <?= $content ?>
    </div>
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
