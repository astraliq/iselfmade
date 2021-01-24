<?php


namespace app\rules;

use yii\rbac\Item;
use yii\rbac\Rule;

class AddReportCommentRule extends Rule {
    public $name = 'addReportCommentRule';

    /**
     * @param int|string $user
     * @param \yii\rbac\Item $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params) {
        $user_id = $params['report']->user_id;

        return $user_id == $user;
    }

}