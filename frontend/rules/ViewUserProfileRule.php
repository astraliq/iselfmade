<?php


namespace frontend\rules;


use yii\rbac\Item;
use yii\rbac\Rule;

class ViewUserProfileRule extends Rule {
    public $name = 'viewUserProfileRule';

    /**
     * @param int|string $user
     * @param Item $item
     * @param array $params
     * @return bool|void
     */
    public function execute($user, $item, $params) {
        $foundUser = $params['user'];

        return $foundUser->id == $user;
    }


}