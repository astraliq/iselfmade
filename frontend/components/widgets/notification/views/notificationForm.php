<?php



/* @var $this \yii\web\View */
/* @var $notifs  */
?>


<?php
    if ($notifs) {
        $notifs = array_reverse($notifs, true);
        foreach ($notifs as $notif) {
            echo \frontend\components\widgets\notification\OneNotifWidget::widget([
                'notif' => $notif,
            ]);
        }
    } else {
        echo '<p class="comments__no">Уведомлений нет</p>';
    }
?>

