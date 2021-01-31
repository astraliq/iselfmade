<?php


namespace app\widgets\notification;


use yii\base\Widget;

class OneNotifWidget extends Widget {
    public $notif;

    public function run() {

        return $this->render('oneNotifView',[
            'notif' => $this->notif,
        ]);
    }
}