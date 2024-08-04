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
<style>
    .logo {
        text-decoration: none;
        font-weight: 600;
    }
    .blue_logo {
        color: #4C91F8;
    }
    .black_logo {
        color: #000;
    }
    .logo:hover .blue_logo {
        color: #000;
     }

    .logo:hover .black_logo {
        color: #4C91F8;
     }

</style>
<p>Вы получили это письмо, потому что кто-то, скорее всего Вы, начал процедуру смены пароля для профиля: <?= Html::encode($email)?></p>
<p>Скопируйте код подтверждения в форму установки нового пароля:</p>
<div class="token" style="width: 200px; height: 40px; background-color: gray; border-radius: 5px"><span style="font-size: 16px; color: whitesmoke; text-align: center; display: block; line-height: 40px;"><?=$token?></span></div>
<p>или передите по ссылке: <a href="<?=\Yii::$app->params['homeUrl_http'] . 'auth/restore-password?email=' . $email . '&token=' . $token?>">восстановить пароль</a></p>
<p>Если это какая-то ужасная ошибка — просто проигнорируйте это письмо. Без указания кода подтверждения сменить пароль невозможно.</p>
<p>Это письмо отправлено роботом, отвечать на него не нужно.</p>
<p>С уважением, <br>Команда <a href="<?= \Yii::$app->params['homeUrl_http'] ?>" class="logo"><span class="black_logo">i</span><span class="blue_logo">self</span><span class="black_logo">made</span></a></p>

