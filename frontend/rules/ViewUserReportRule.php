<?php


namespace frontend\rules;


use yii\rbac\Rule;

class ViewUserReportRule extends Rule {
    public $name = 'viewUserReportRule';

    public function execute($user, $item, $params) {
        $user_id = $params['report']->user_id;

        return $user_id == $user;
    }
}