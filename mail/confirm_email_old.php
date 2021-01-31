<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>

<?php


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
<p>Приветствуем Вас!</p>
<br>
<p>До конца регистрации осталось совсем чуть-чуть</p>
<a style="text-decoration:none;border: 0;background: #4C91F8;color: #fff;text-decoration: none;padding: 8px 16px;border-radius: 4px;font-size: 14px;" href="<?=Url::home('https') . 'auth/confirmation-email?email=' . $email . '&confirmation_token=' . $confirmation_token?>">Подтвердить почтовый адрес</a>
<br>
<br>
<p>Если это какая-то ужасная ошибка — просто проигнорируйте это письмо.</p>
<p>Это письмо отправлено роботом, отвечать на него не нужно.</p>
<hr>
<p>С наилучшими пожеланиями, <br>Команда <a href="<?= Url::home('https') ?>" class="logo"><span class="black_logo">i</span><span class="blue_logo">self</span><span class="black_logo">made</span></a></p>

