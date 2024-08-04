<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap5\Nav;
use yii\helpers\Html;
use frontend\assets\AppAsset;
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
<!--    <div class="custom_light">-->
<!--        <div class="">-->
<!--            <img class="user_img" src="--><?//= Html::encode($avatarImage) ?><!--" width="60" height="60">-->
<!--        </div>-->
<!--    </div>-->
<?php $this->beginBody() ?>
<div class="container">
    <menu class="top-menu" id="top-menu">
<!--        <a class="top-menu__link" href="#">Антислив</a>-->
<!--        <a class="top-menu__link" href="#">Рейтинг</a>-->
        <span class="notification" id="notifications">
                    <svg class="bell" id="Layer_2" enable-background="new 0 0 24 24" height="22" viewBox="0 0 24 24" width="22" xmlns="http://www.w3.org/2000/svg"><g><path class="bell"  d="m13.5 4.18c-.276 0-.5-.224-.5-.5v-1.68c0-.551-.449-1-1-1s-1 .449-1 1v1.68c0 .276-.224.5-.5.5s-.5-.223-.5-.5v-1.68c0-1.103.897-2 2-2s2 .897 2 2v1.68c0 .277-.224.5-.5.5z"/></g><g><path class="bell"  d="m12 24c-1.93 0-3.5-1.57-3.5-3.5 0-.276.224-.5.5-.5s.5.224.5.5c0 1.378 1.122 2.5 2.5 2.5s2.5-1.122 2.5-2.5c0-.276.224-.5.5-.5s.5.224.5.5c0 1.93-1.57 3.5-3.5 3.5z"/></g><g><path class="bell"  d="m20.5 21h-17c-.827 0-1.5-.673-1.5-1.5 0-.439.191-.854.525-1.14 1.576-1.332 2.475-3.27 2.475-5.322v-3.038c0-3.86 3.14-7 7-7 3.86 0 7 3.14 7 7v3.038c0 2.053.899 3.99 2.467 5.315.342.293.533.708.533 1.147 0 .827-.672 1.5-1.5 1.5zm-8.5-17c-3.309 0-6 2.691-6 6v3.038c0 2.348-1.028 4.563-2.821 6.079-.115.098-.179.237-.179.383 0 .276.224.5.5.5h17c.276 0 .5-.224.5-.5 0-.146-.064-.285-.175-.38-1.796-1.519-2.825-3.735-2.825-6.082v-3.038c0-3.309-2.691-6-6-6z"/></g></svg>
            <span id="info-bell" style="display: none"></span>
            <div class="notification__block invisible d-none" id="notification__block">
                <?php echo \frontend\components\widgets\notification\NotificationsWidget::widget([
                    'notifs' => $this->params['notifs'],
                ])?>
            </div>
        </span>
        <div class="user_menu">
            <img class="user__img" id="user__img" src="<?= Html::encode($avatarImage) ?>" width="40" height="40" alt="Моё фото">
            <div class="user_menu__block invisible d-none" id="user_menu">
                <?php echo \frontend\components\widgets\menu\MainMenuWidget::widget([
                    'user' => $this->params['user'],
                ])?>
            </div>
        </div>

    </menu>
    <div class="left-menu">
        <div class="left-menu sticky">
            <div class="date">
                <div class="date-numb">
                    <p class="number"><?= date('d') ?></p>
                    <p class="month"><?= \Yii::$app->params['monthsShort'][\Yii::$app->formatter->asDate(date('d.m.Y'), 'M')];?>.</p>
                </div>
                <p class="date__text"><?= \Yii::$app->formatter->asDate(date('Y-m-d'), 'php: l')?></p>
                <p class="date__text">Неделя: <span class="date__numb"><?= date('W') ?>/<?= date('W',mktime(0,0,0,12,31,date('Y')));?></span></p>
                <p class="date__text">День: <span class="date__numb"><?=date('z')+1?>/<?=date('L')?366:365?></span></p>
            </div>
            <div class="line"></div>

            <div class="menu">
                <?php
                $url = explode('?', \Yii::$app->request->getUrl())[0];
                echo Nav::widget([
                    'options' => ['class' => 'menu__items'],
                    'items' => [
                        ['label' => 'Доска эффективности',
                            'url' => ['/board'],
                            'options' => ['class' => $url=='/board' ? 'menu__item_selected' : ''],
                            'linkOptions' => ['class' => 'menu__item offline'],
                        ],
                        ['label' => 'Отчёт за сегодня',
                            'url' => ['/report'],
                            'options' => ['class' => $url=='/report' ? 'menu__item_selected' : ''],
                            'linkOptions' => ['class' => 'menu__item'],
                        ],
                        ['label' => 'Прошлые отчёты',
                            'url' => ['/archive'],
                            'options' => ['class' => $url=='/archive' ? 'menu__item_selected' : ''],
                            'linkOptions' => ['class' => 'menu__item'],
                        ],
                    ],
                ]);
                ?>
                <div class="dop-menu">
                    <?php
                    $url = explode('?', \Yii::$app->request->getUrl())[0];
                    echo Nav::widget([
                        'options' => ['class' => 'menu__items'],
                        'items' => [
                            ['label' => 'Повторяющиеся дела',
                                'url' => ['/repeated'],
                                'options' => ['class' => $url=='/repeated' ? 'menu__item_selected' : ''],
                                'linkOptions' => ['class' => 'menu__item'],
                            ],
                            ['label' => 'Будущие дела',
                                'url' => ['/future'],
                                'options' => ['class' => $url=='/future' ? 'menu__item_selected' : ''],
                                'linkOptions' => ['class' => 'menu__item offline'],
                            ],
                            ['label' => 'Возможные дела',
                                'url' => ['/possible'],
                                'options' => ['class' => $url=='/possible' ? 'menu__item_selected' : ''],
                                'linkOptions' => ['class' => 'menu__item offline'],
                            ],
                            ['label' => 'Мои обещания',
                                'url' => ['/promises'],
                                'options' => ['class' => $url=='/promises' ? 'menu__item_selected' : ''],
                                'linkOptions' => ['class' => 'menu__item offline'],
                            ],
                            ['label' => 'Группа поддержки',
                                'url' => ['/group'],
                                'options' => ['class' => $url=='/group' ? 'menu__item_selected' : ''],
                                'linkOptions' => ['class' => 'menu__item offline'],
                            ],
//                            ['label' => 'Остальные сервисы',
//                                'url' => ['/others'],
//                                'options' => ['class' => $url=='/others' ? 'menu__item_selected' : ''],
//                                'linkOptions' => ['class' => 'menu__item offline'],
//                            ],
                        ],
                    ]);
                    ?>
                </div>
                <div class="dop-menu">
                    <?php
                    $url = \Yii::$app->request->url;
                    echo Nav::widget([
                        'options' => ['class' => 'menu__items'],
                        'items' => [
                            $mentorCan ? ((['label' => 'Проверка отчетов',
                                'url' => ['/check-reports'],
                                'options' => ['class' => $url=='/check-reports' ? 'menu__item_selected' : ''],
                                'linkOptions' => ['class' => 'menu__item'],
                            ])) : (''),
                            $mentorCan ? ((['label' => 'Сводный отчет',
                                'url' => ['/statistics'],
                                'options' => ['class' => $url=='/statistics' ? 'menu__item_selected' : ''],
                                'linkOptions' => ['class' => 'menu__item'],
                            ])) : (''),
                            (['label' => 'Настройки',
                                'options' => ['class' => 'menu__settings', 'id' => 'menu__settings'],
                                'linkOptions' => ['class' => 'menu__item'],
                            ]),
                        ],
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => $url=='/goals' || $url=='/mentor' ? 'settings__items' : 'settings__items d-none invisible', 'id' => 'settings__items'],
                        'items' => [
                            ['label' => 'Цели и задачи',
                                'url' => ['/goals'],
                                'options' => ['class' => $url=='/goals' ? 'menu__item_selected menu__set' : ' menu__set'],
                                'linkOptions' => ['class' => 'menu__item menu__link_sett'],
                            ],
                            ['label' => 'Наставник',
                                'url' => ['/mentor'],
                                'options' => ['class' => $url=='/mentor' ? 'menu__item_selected menu__set' : ' menu__set'],
                                'linkOptions' => ['class' => 'menu__item menu__link_sett'],
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>

    </div>
    <div class="main__data">
        <?= $content ?>
    </div>

</div>

<!-- Yandex.Metrika counter -->
<!--<script type="text/javascript" >-->
<!--    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};-->
<!--        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})-->
<!--    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");-->
<!---->
<!--    ym(72420883, "init", {-->
<!--        clickmap:true,-->
<!--        trackLinks:true,-->
<!--        accurateTrackBounce:true,-->
<!--        webvisor:true-->
<!--    });-->
<!--</script>-->
<!--<noscript><div><img src="https://mc.yandex.ru/watch/72420883" style="position:absolute; left:-9999px;" alt="" /></div></noscript>-->
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
