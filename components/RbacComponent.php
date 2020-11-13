<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Tasks;
use app\models\User;
use app\rules\OwnerTaskRule;
use app\rules\ViewUserProfileRule;
use yii\console\ExitCode;
use yii\db\Exception;
use yii\helpers\Console;
use yii\rbac\ManagerInterface;
use yii\web\HttpException;

class RbacComponent extends BaseComponent {

    private function getManager(): ManagerInterface {
        return \Yii::$app->authManager;
    }

    public function generateRbac() {
        $manager = $this->getManager();
//        $manager->removeAll();
        $manager->removeAllAssignments();
        $manager->removeAllPermissions();
        $manager->removeAllRoles();
        $manager->removeAllRules();

        $admin = $manager->createRole('admin');
        $user = $manager->createRole('user');
        $curator = $manager->createRole('curator');
        $moderator = $manager->createRole('moderator');
        $buddy = $manager->createRole('buddy');

        $manager->add($admin);
        $manager->add($user);
        $manager->add($curator);
        $manager->add($moderator);
        $manager->add($buddy);

        $ownerTaskRule = new OwnerTaskRule();
        $manager->add($ownerTaskRule);
        $viewUserProfileRule = new ViewUserProfileRule();
        $manager->add($viewUserProfileRule);

        $createTasks = $manager->createPermission('createTasks');
        $createTasks->description = 'Создание задач';
        $manager->add($createTasks);

        $updateOwnTasks = $manager->createPermission('updateOwnTasks');
        $updateOwnTasks->description = 'Изменение своих задач';
        $updateOwnTasks->ruleName = $ownerTaskRule->name;
        $manager->add($updateOwnTasks);

        $viewOwnTasks = $manager->createPermission('viewOwnTasks');
        $viewOwnTasks->description = 'Просмотр своих задач';
        $viewOwnTasks->ruleName = $ownerTaskRule->name;
        $manager->add($viewOwnTasks);

        $deleteOwnTasks = $manager->createPermission('deleteOwnTasks');
        $deleteOwnTasks->description = 'Удаление своих задач';
        $deleteOwnTasks->ruleName = $ownerTaskRule->name;
        $manager->add($deleteOwnTasks);

        $viewUserTasks = $manager->createPermission('viewUserTasks');
        $viewUserTasks->description = 'Просмотр задач пользователя';
        $viewUserTasks->ruleName = $ownerTaskRule->name;
        $manager->add($viewUserTasks);

        $viewAllUsersTasks = $manager->createPermission('viewAllUsersTasks');
        $viewAllUsersTasks->description = 'Просмотр задач всех пользователей';
        $manager->add($viewAllUsersTasks);

        $updateAllUsersTasks = $manager->createPermission('updateAllUsersTasks');
        $updateAllUsersTasks->description = 'Изменение задач всех пользователей';
        $manager->add($updateAllUsersTasks);

        $deleteAllUsersTasks = $manager->createPermission('deleteAllUsersTasks');
        $deleteAllUsersTasks->description = 'Удаление задач всех пользователей';
        $manager->add($deleteAllUsersTasks);

        $viewOwnProfile = $manager->createPermission('viewOwnProfile');
        $viewOwnProfile->description = 'Просмотр своих данных профиля';
        $manager->add($viewOwnProfile);

        $updateOwnProfile = $manager->createPermission('updateOwnProfile');
        $updateOwnProfile->description = 'Изменение своих данных профиля';
        $manager->add($updateOwnProfile);

        $viewUserProfile = $manager->createPermission('viewUserProfile');
        $viewUserProfile->description = 'Просмотр данных пользователя';
        $viewUserProfile->ruleName = $viewUserProfileRule->name;
        $manager->add($viewUserProfile);

        $updateUserProfile = $manager->createPermission('updateUserProfile');
        $updateUserProfile->description = 'Изменение данных пользователя';
        $updateUserProfile->ruleName = $viewUserProfileRule->name;
        $manager->add($updateUserProfile);

        $viewAllUsersProfile = $manager->createPermission('viewAllUsersProfile');
        $viewAllUsersProfile->description = 'Просмотр данных всех пользователей';
        $manager->add($viewAllUsersProfile);

        $updateAllUsersProfile = $manager->createPermission('updateAllUsersProfile');
        $updateAllUsersProfile->description = 'Изменение данных всех пользователей';
        $manager->add($updateAllUsersProfile);

        $deleteUser = $manager->createPermission('deleteUser');
        $deleteUser->description = 'Удаление пользователя';
        $manager->add($deleteUser);

        $manager->addChild($user,$createTasks);
        $manager->addChild($user,$updateOwnTasks);
        $manager->addChild($user,$viewOwnTasks);
        $manager->addChild($user,$deleteOwnTasks);
        $manager->addChild($user,$viewOwnProfile);
        $manager->addChild($user,$updateOwnProfile);

        $manager->addChild($curator,$createTasks);
        $manager->addChild($curator,$updateOwnTasks);
        $manager->addChild($curator,$viewOwnTasks);
        $manager->addChild($curator,$deleteOwnTasks);
        $manager->addChild($curator,$viewOwnProfile);
        $manager->addChild($curator,$updateOwnProfile);
        $manager->addChild($curator,$viewUserProfile);
        $manager->addChild($curator,$viewUserTasks);

        $manager->addChild($buddy,$createTasks);
        $manager->addChild($buddy,$updateOwnTasks);
        $manager->addChild($buddy,$viewOwnTasks);
        $manager->addChild($buddy,$deleteOwnTasks);
        $manager->addChild($buddy,$viewOwnProfile);
        $manager->addChild($buddy,$updateOwnProfile);
        $manager->addChild($buddy,$viewUserProfile);
        $manager->addChild($buddy,$viewUserTasks);

        $manager->addChild($moderator,$user);
        $manager->addChild($moderator,$viewAllUsersTasks);
        $manager->addChild($moderator,$updateAllUsersTasks);
        $manager->addChild($moderator,$deleteAllUsersTasks);
        $manager->addChild($moderator,$viewAllUsersProfile);
        $manager->addChild($moderator,$updateAllUsersProfile);

        $manager->addChild($admin,$moderator);
        $manager->addChild($admin,$deleteUser);

    }

    public function setAllRolesToUser() {
        $users = \Yii::$app->dao->getUsersList();
        $manager = $this->getManager();
        $role = $manager->getRole('user');
        try  {
            foreach ($users as $user) {
                $manager->revokeAll($user['id']);
                $manager->assign($role,$user['id']);
            }
        } catch (Exception $e){
            return false;
        }
        return true;
    }

    public function setAdminRole($id) {
        //Проверяем обязательный параметр id
        if(!$id || is_int($id)){
            // throw new \yii\base\InvalidConfigException("param 'id' must be set");
//            $this->controller->stdout("Param 'id' must be set!\n", Console::BG_RED);
//            return ExitCode::UNSPECIFIED_ERROR;
            return false;
        }
        //Есть ли пользователь с таким id
        $user = (new User())->findIdentity($id);
        if(!$user){
            // throw new \yii\base\InvalidConfigException("User witch id:'$id' is not found");
//            $this->controller->stdout("User witch id:'$id' is not found!\n", Console::BG_RED);
//            return ExitCode::UNSPECIFIED_ERROR;
            return false;
        }
        $manager = $this->getManager();
        $role = $manager->getRole('admin');
        $manager->revokeAll($id);
        $manager->assign($role,$id);

        return true;
    }

    public function setUserRole($id) {
        //Проверяем обязательный параметр id
        if(!$id || is_int($id)){
            // throw new \yii\base\InvalidConfigException("param 'id' must be set");
//            $this->controller->stdout("Param 'id' must be set!\n", Console::BG_RED);
//            return ExitCode::UNSPECIFIED_ERROR;
            return false;
        }
        //Есть ли пользователь с таким id
        $user = (new User())->findIdentity($id);
        if(!$user){
            // throw new \yii\base\InvalidConfigException("User witch id:'$id' is not found");
//            $this->controller->stdout("User witch id:'$id' is not found!\n", Console::BG_RED);
//            return ExitCode::UNSPECIFIED_ERROR;
            return false;
        }
        $manager = $this->getManager();
        $role = $manager->getRole('user');
        $manager->revokeAll($id);
        $manager->assign($role,$id);


        return true;
    }

    public function setCuratorRole($id) {
        if(!$id || is_int($id)){
            return false;
        }
        $user = (new User())->findIdentity($id);
        if(!$user){
            return false;
        }
        $manager = $this->getManager();
        $role = $manager->getRole('curator');
        $manager->revokeAll($id);
        $manager->assign($role,$id);
        return true;
    }

    public function setBuddyRole($id) {
        if(!$id || is_int($id)){
            return false;
        }
        $user = (new User())->findIdentity($id);
        if(!$user){
            return false;
        }
        $manager = $this->getManager();
        $role = $manager->getRole('buddy');
        $manager->revokeAll($id);
        $manager->assign($role,$id);
        return true;
    }

    public function canAccessCRUDTask($taskId, Tasks $model, $user_id=null) {
        if ($this->canViewAll()) { // если админ
            if ($user_id) {
                $task = $model->find()->where(['user_id' => $user_id,'id' => $taskId])->one();
                if (!$task) {
                    throw new HttpException(404, 'Задача не найдена');
                }
        }
        } else {
            if (!\Yii::$app->rbac->canViewOwnTask($model)) {
                throw new HttpException(403,'Нет доступа');
            }
        }
        return true;
    }

    public function canCreateTask():bool {
        return \Yii::$app->user->can('createTasks');
    }

    public function canViewOwnTask(Tasks $task=null):bool{
        if (\Yii::$app->user->can('admin')) {
            return true;
        }

        if ($task) {
            if (\Yii::$app->user->can('viewOwnTasks', ['task' => $task])) {
                return true;
            }
        }

        if (\Yii::$app->user->can('viewOwnTasks')) {
            return true;
        }
        return false;
    }

    public function canViewAll():bool {
        if (\Yii::$app->user->can('admin')) {
            return true;
        }
        return false;
    }

    public function canViewOwnProfile():bool {
        if (\Yii::$app->user->can('admin')) {
            return true;
        }
        if (\Yii::$app->user->can('viewOwnProfile')) {
            return true;
        }
        return false;
    }

    public function canUpdateOwnProfile():bool {
        if (\Yii::$app->user->can('admin')) {
            return true;
        }
        if (\Yii::$app->user->can('updateOwnProfile')) {
            return true;
        }
        return false;
    }

    public function canViewUserProfile(User $user):bool {
        if (\Yii::$app->user->can('admin')) {
            return true;
        }

        if (\Yii::$app->user->can('viewUserProfile', ['user' => $user])) {
            return true;
        }
        return false;
    }

    public function updateAllUsersProfile():bool {
        if (\Yii::$app->user->can('admin')) {
            return true;
        }
        if (\Yii::$app->user->can('updateAllUsersProfile')) {
            return true;
        }
        return false;
    }


}