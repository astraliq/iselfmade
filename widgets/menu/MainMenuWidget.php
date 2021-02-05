<?php


namespace app\widgets\menu;


use yii\base\Widget;

class MainMenuWidget extends Widget {
    public $user;

    public function run() {
        return $this->render('mainMenuForm', [
            'user' => $this->user,
        ]);
    }
}