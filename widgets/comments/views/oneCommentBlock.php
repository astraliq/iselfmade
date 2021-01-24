<?php
/* @var $this \yii\web\View */
/* @var $comments  */
/* @var $selfId  */
if ($comment->user_id === $self->id) {
    $self_user = 'self_user';
    $self_info = false;
} else {
    $self_user = '';
    $self_info = true;
}

if ($comment->user->avatar) {
    $avatar = '/users/ava/' . $comment->user->avatar;
} else {
    $avatar = '/img/user_img.jpg';
}

use yii\helpers\Html; ?>

<div class="comments__item">
    <div class="user <?=$self_user?>">
        <div class="user__bio">
            <div class="user__bio-ava">
                <img class="user__img" src="<?=Html::encode($avatar)?>" alt="avatar" width="60" height="auto">
            </div>
            <p class="user__name"><?=Html::encode($comment->user->name)?> <?=Html::encode($comment->user->surname)?></p>
        </div>
        <div class="user__comment"><?=nl2br(Html::encode($comment->comment))?></div>
    </div>
</div>


