<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>

<?php

if ($username) {
    echo '<p>Здравствуйте, ' . Html::encode($username) . '! </p>';
} else {
    echo '<p>Здравствуйте!</p>';
}

?>
<p>Вы получили это письмо, потому что кто-то, скорее всего Вы, начал процедуру смены пароля для профиля: <?= Html::encode($email)?></p>
<p>Скопируйте код подтверждения в форму установки нового пароля:</p>
<div class="token" style="width: 300px; height: 50px; background-color: gray; border-radius: 5px"><span style="font-size: 16px; color: whitesmoke;"><?=$token?></span></div>
<p>или передите по ссылке: <a href="<?=Url::home('https') . '/auth/restore-password'?>">восстановить пароль</a></p>
<p>Если это какая-то ужасная ошибка — просто проигнорируйте это письмо. Без указания кода подтверждения сменить пароль невозможно.</p>
<p>Это письмо отправлено роботом, отвечать на него не нужно.</p>
<p>С уважением, <br>Команда <a href="<?= Url::home('https') ?>">iselfmade</a></p>

