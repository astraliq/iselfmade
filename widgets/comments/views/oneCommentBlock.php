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
$files = '';

if ($comment->files) {
    $uploadedFiles = explode('/', $comment->files);
    foreach ($uploadedFiles as $file) {
        $files .= '<img class="input_img" src="/users/report_files/' . $comment->user_id . '/' . $file . '" alt="' . $file . '" title="' . $file . '" data-name="' . $file . '" height="100">';
    };
}

if ($comment->user->avatar) {
    $avatar = '/users/ava/' . $comment->user->avatar;
} else {
    $avatar = '/img/user_img.jpg';
}
$today = gmdate('d.m.Y');
$date = \Yii::$app->formatter->asDateTime($comment->date_create, 'php:d.m.Y');
$realDate = '';
if ($date == $today) {
    $realDate = \Yii::$app->formatter->asDateTime($comment->date_create, 'php:H:i:s');
} elseif ($date == ($today - 1)) {
    $realDate = \Yii::$app->formatter->asDateTime($comment->date_create, 'php:Вчера, H:i:s');
} else {
    $realDate = \Yii::$app->formatter->asDateTime($comment->date_create, 'php:d F Y, H:i:s');
}



use yii\helpers\Html;

?>

<div class="comments__item">
    <div class="user <?=$self_user?>">
        <div class="user__bio">
            <div class="user__bio-ava">
                <img class="user__img" src="<?=Html::encode($avatar)?>" alt="avatar" width="60" height="auto">
            </div>
            <p class="user__name"><?=Html::encode($comment->user->name)?> <?=Html::encode($comment->user->surname)?></p>
        </div>

        <div class="user__comment"><div class="comments__uploaded_files" id="comments__uploaded_files-<?=$comment->id?>"><?=$files?></div>
            <?=nl2br(Html::encode($comment->comment))?>
            <p class="date"><?=$realDate?></p>
        </div>
    </div>
</div>


