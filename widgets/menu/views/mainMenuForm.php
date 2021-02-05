<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $user  */
?>

<?php
echo Nav::widget([
    'options' => ['class' => 'user_menu__items'],
    'items' => [
        (['label' => 'Профиль',
            'url' => ['/profile'],
            'options' => ['class' => 'user_menu__option'],
            'linkOptions' => ['class' => 'user_menu__item'],
        ]),
        (
            '<li class="user_menu__option">'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . $user->email . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        ),
    ],
]);
?>
