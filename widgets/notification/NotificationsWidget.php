<?php


namespace app\widgets\notification;


use yii\base\Widget;

class NotificationsWidget extends Widget {
    public $notifs;

    public function run() {

        return $this->render('notificationForm',[
            'notifs' => $this->notifs,
        ]);
    }
}