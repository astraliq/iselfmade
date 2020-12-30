<?php

/* @var $this yii\web\View */

$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];

use yii\helpers\Html;

?>

<h3>ОТЧЕТЫ</h3>


<?= $this->render('/modals/confirm_email',['notifConfEmail' => $notifConfEmail]); ?>

