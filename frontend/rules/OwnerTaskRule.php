<?php


namespace frontend\rules;


use yii\rbac\Item;
use yii\rbac\Rule;

class OwnerTaskRule extends Rule
{
    public $name = 'ownerTaskRule';
    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params) {
        if ($params) {
            $task = $params['task'];
//            echo '<pre>';
//            echo '$user - ' . $user;
//            echo '<br>';
//            echo '<br>';
//            echo '$task->user_id - ' . $task->user_id;
//            echo '<br>';
//            echo '</pre>';
//            exit();
            if ($task) {
                return $task->user_id == $user;
            }
        }
        return true;
    }
}