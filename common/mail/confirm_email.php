<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>

<?php


?>
<style>
</style>
<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0">
        <tr>
            <td height="100%">
                <center style="max-width: 600px; width: 100%;">
                    <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0">
                        <tr>
                            <td cellpadding="0" cellspacing="0" style="margin:0; padding:0">
                                <h1 style="font-family: 'Roboto', sans-serif; font-weight: bold; font-size: 50px; line-height: 95%; color: #000000;">
                                    Хорошо, что ты теперь с нами!</h1>
                            </td>
                        </tr>
                        <tr cellpadding="0" cellspacing="0" style="margin:0; padding:0;">
                            <td cellpadding="0" cellspacing="0" style="margin:0; padding:0;height: 300px;">
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 30px; line-height: 30px; color: #000000; height: 10px ">С чего начать</p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000;">Заполни свои <a style="color: #4C91F8; -webkit-text-size-adjust:none;" target="_blank" href="<?=\Yii::$app->params['homeUrl_http'] . 'goals'?>">цели на год и задачи</a> на ближайший месяц. Они всегда будут доступны тебе в разделе «Отчёт». Их в любой момент можно там
                                    отредактировать.
                                </p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000;">Мы используем такие формулировки и определения. Цель&nbsp;&#151; что&#150;то глобальное, &laquo;большое&raquo;. Как правило то, что планируешь достигнуть в течении года (не обязательно календарного). Чтобы её достичь, мы
                                    разбиваем цель на задачи. Примерный срок выполнения задачи&nbsp;&#151; месяц. Задачи же состоят из дел, которые мы выполняем каждый день. </p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000;">Цель &#10144; Задача &#10144; Дело</p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000;">После целей и задач заполни <a style="color: #4C91F8; -webkit-text-size-adjust:none; target="_blank" href="<?=\Yii::$app->params['homeUrl_http'] . 'profile'?>">свой профиль</a>. Твоё имя и фото нужны для наставника, ментора и работе в группе поддержки.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 30px; line-height: 40px; color: #000000; height: 10px ">Антислив</p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000; ">
                                    Мы поняли, что основная сложность не в том, чтобы начать что–то делать, а в том, чтобы продолжать делать то, что уже начали каждый день.
                                </p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000; ">
                                    Именно для этого мы придумали дополнительные сервисы и раздел &laquo;<a style="color: #4C91F8; -webkit-text-size-adjust:none; " target="_blank " href="<?=\Yii::$app->params['homeUrl_http'] . 'anti-leak'?>">Антислив</a>&raquo;. Там полезные материалы, чтобы
                                    продолжать и продолжать делать то, что у тебя в планах.
                                </p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000; ">
                                    У тебя будет персональный куратор. Его основная задача проверять твой отчёт каждый день, в течении 24–х часов. А в тарифах «Результат» и «Прорыв», куратор ещё и звонит тебе по телефону, чтобы узнать как много дел уже выполнено.
                                </p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000;
                                        ">
                                    Наставник&nbsp;&#151; человек, перед которым тебе будет очень стыдно облажаться и не выполнить свои дела. Система так настроена, что ему на почту будет приходить отчёт о твоей эффективности. Но для этого, <a style="color: #4C91F8; -webkit-text-size-adjust:none; "
                                        target="_blank " href="<?=\Yii::$app->params['homeUrl_http'] . 'mentor'?>">укажи почту наставника</a> в соответствующих настройках. И выполняй всё, что записано в твоём плане&nbsp;&#151; не расстраивай своего Наставника.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 30px; line-height: 40px; color: #000000; height: 10px ">Чат поддержки и соцсети</p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000 ">
                                    Подписывайся на наши официальные аккаунты в соцсетях и получай интересную и полезную информацию там, где тебе удобнее всего.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="0 " cellpadding="0 " cellspacing="0 " style="margin:0; padding:0 ">
                                    <tr>
                                        <td width="50 "><a href="https://www.instagram.com/iselfmade.ru/">
                                            <img src="<?=\Yii::$app->params['homeUrl_http'] . 'img/letter/icons/instagram.png'?>" width="40 " height="40 " border="0 " alt=" "></a>
                                        </td>
                                        <td width="50 "><a href="https://twitter.com/iselfmaderu">
                                            <img src="<?=\Yii::$app->params['homeUrl_http'] . 'img/letter/icons/twitter.jpg'?>" width="40 " height="40 " border="0 " alt=" "></a>
                                        </td>
                                        <td width="50 "><a href="#">
                                            <img src="<?=\Yii::$app->params['homeUrl_http'] . 'img/letter/icons/facebook.png'?>" width="40 " height="40 " border="0 " alt=" "></a>
                                        </td>
                                        <td width="50 "><a href="https://vk.com/iselfmaderu">
                                            <img src="<?=\Yii::$app->params['homeUrl_http'] . 'img/letter/icons/vk.png'?>" width="40 " height="40 " border="0 " alt=" "></a>
                                        </td>
                                        <td width="50 "><a href="https://t.me/iselfmaderu">
                                            <img src="<?=\Yii::$app->params['homeUrl_http'] . 'img/letter/icons/telegram.png'?>" width="40 " height="40 " border="0 " alt=" "></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000 ">
                                    Общий <a style="color: #4C91F8; -webkit-text-size-adjust:none; " target="_blank " href="https://t.me/joinchat/WAi-c9XitRYBK6k3 ">чат поддержки в телеграм</a> для всех участников.<br> Присоединяйся, задавай
                                    вопросы, поддерживай других и делись своими успехами.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 30px; line-height: 40px; color: #000000; height: 10px ">Напоследок</p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000 ">
                                    Всю необходимую информацию о работе сервиса ты всегда сможешь прочитать в разделе &laquo;<a style="color: #4C91F8; -webkit-text-size-adjust:none; " target="_blank " href="<?=\Yii::$app->params['homeUrl_http'] . 'help'?>">Помощь</a>&raquo;. А если там
                                    нет ответа на твой вопрос, то смело пиши нам <a style="color: #4C91F8; -webkit-text-size-adjust:none; " target="_blank " href="#">любым из этих способов</a>.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 30px; line-height: 40px; color: #000000; height: 10px ">Мне всё понятно</p>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000; padding-bottom: 10px; ">
                                    Отлично.<br>Тогда давай начинать.</p>
                                    <a style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 30px; line-height: 40px; text-decoration:none;border: 0;background: #4C91F8;color: #ffffff;text-decoration: none;padding: 8px 16px;border-radius:15px;
                                        " href="<?=\Yii::$app->params['homeUrl_http'] . 'auth/confirmation-email?email=' . $email . '&confirmation_token=' . $confirmation_token?>">Подтверди свою почту</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <br>
                                <p style="font-family: 'Roboto', sans-serif; font-weight: normal; font-size: 19px; line-height: 24px; color: #000000; padding-bottom: 10px;">
                                    Это письмо отправлено роботом, но если если ты решишь ответить на него, то его прочитает живой человек.</p>
                            </td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>
    </table>