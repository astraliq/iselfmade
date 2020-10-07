<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'TEST';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <pre>
        <?= print_r($test); ?>
    </pre>

</div>
