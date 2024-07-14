<?php
/**
 * @var $title - заголовок */

use yii\helpers\Html;


?>

<h1><?= $title ?> </h1>


<?= $provider = \yii\grid\GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            'id',
            'task',
            'date_create',

        ],
    ]
)?>