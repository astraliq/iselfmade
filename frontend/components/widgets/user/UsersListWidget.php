<?php


namespace frontend\components\widgets\user;

use yii\base\Widget;

class UsersListWidget extends Widget {
    public $users;

    public function run() {
        return $this->render('usersListRow', [
            'users' => $this->users,
        ]);
    }
}