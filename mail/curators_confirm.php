<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

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
<h3>Приветствуем Вас!</h3>
<br>
<p>Пользователь нашего сервиса - <?=$name?>, выбрал Вас в качестве куратора.</p>
<p>Вам будут регулярно приходить на почту письма с отчетами о выполнении им ежедневных задач.</p>
<p>Регулярность писем будет зависить от настроек пользователя.</p>
<br>
<p>Для подтверждения получения писем передите по ссылке:</p>
<a href="<?=Url::home('https') . 'user/confirmation-curators-email?user=' . $userId . '&confirmation_token=' . $confirmation_token?>">Подтвердить</a>
<br>
<p>Если письмо пришло к Вам по ошибке или Вы не желаете быть куратором пользователя <?=$name?> - просто проигнорируйте это письмо.</p>
<br>
<br>
<p>Это письмо отправлено роботом, отвечать на него не нужно.</p>
<hr>
<p>С наилучшими пожеланиями, <br>Команда <a href="<?= Url::home('https') ?>" class="logo"><span class="black_logo">i</span><span class="blue_logo">self</span><span class="black_logo">made</span></a></p>

