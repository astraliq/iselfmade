<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="error_block">
    <div class="error_desc">
        <h1 class="error_title"><?= Html::encode($this->title) ?></h1>

        <div class="error_alert alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>Данная ошибка произошла во время обработки вашего запроса веб-сервером.</p>
        <p>Свяжитесь с нами, если вы считаете, что это ошибка сервера. Спасибо.</p>
    </div>
</div>
