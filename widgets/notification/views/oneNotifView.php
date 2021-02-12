<?php
$today = gmdate('d.m.Y');
$date = \Yii::$app->formatter->asDateTime($notif->date_create, 'php:d.m.Y');
$realDate = '';
if ($date == $today) {
    $realDate = \Yii::$app->formatter->asDateTime($notif->date_create, 'php:H:i:s');
} elseif ($date == ($today - 1)) {
    $realDate = \Yii::$app->formatter->asDateTime($notif->date_create, 'php:Вчера, H:i:s');
} else {
    $realDate = \Yii::$app->formatter->asDateTime($notif->date_create, 'php:d F Y, H:i:s');
}

if ($notif->user->avatar) {
    $avatar = '/users/ava/' . $notif->user->avatar;
} else {
    $avatar = '/img/user_img.jpg';
}

if ($notif->report->user_id != \Yii::$app->user->getId()) {
    $notifLink = '/check-reports?id=' . $notif->report_id;
} else {
    $notifLink = '/archive?id=' . $notif->report_id;
}

/* @var $this \yii\web\View */
/* @var $notif  */

use yii\helpers\Html;

?>


<div class="notification__elem">
    <a class="notification__link" href="<?=$notifLink?>">
        <h5 class="title">Новый комментарий</h5>
        <div class="user__bio">
            <div class="user__bio-ava">
                <img class="user__img" src="<?=Html::encode($avatar)?>" alt="avatar" width="60" height="auto">
            </div>
            <div class="name">
                <p class="user__name"><?=Html::encode($notif->user->name)?></p>
                <p class="user__name"><?=Html::encode($notif->user->surname)?></p>
            </div>

        </div>
        <p class="content"><?=Html::encode($notif->comment)?></p>
        <span class="date"><?=$realDate?></span>
    </a>
</div>
