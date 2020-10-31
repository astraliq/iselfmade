<?php


namespace app\components;


use app\models\User;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use yii\base\Component;
use yii\db\Exception;

class AuthComponent extends Component
{

    public function signIn(User $model) :bool {
        if (!$model->validate()){
            return false;
        }

        $user=$this->getUserByEmail($model->email);

        if (!$this->validatePassword($model->password,$user->pass_hash)){
//            $model->addError('email', 'Неверная электронная почта или пароль');
            $model->addError('password', 'Неверная электронная почта или пароль');
            return false;
        };

        return \Yii::$app->user->login($user,0);
    }

    private function validatePassword($password, $pass_hash) {
        return \Yii::$app->security->validatePassword($password, $pass_hash);
    }

    private function getUserByEmail($email){
        return User::find()->andWhere(['email'=>$email])->one();
    }

    public function sendRecoveryPassEmail($email){

        $message = \Yii::$app->mailer->compose('remind_pass')
            ->setFrom('iselfmade@made.ru')
            ->setTo($email)
            ->setSubject('iselfmade - Восстановление пароля')
            ->send();
        return $message;
    }

    public function signUp(User $model) :bool {

        if (!$model->validate()){
            return false;
        }

        $model->pass_hash = $this->genPasswordHash($model->password);

        $authManager = \Yii::$app->authManager;
        $user = $authManager->getRole('user');
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $model->save();
            $authManager->assign($user,$model->getId());
//            throw new Exception('err');
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollback();
            $model->addError('email', 'Произошла ошибка регистрации, обратитесь к администратору');
        }

//        if ($model->save()){
//            if ($authManager->assign($user,$model->getId())) {
//                return true;
//            }
//            $model->addError('email', 'Произошла ошибка регистрации, обратитесь к администратору');
//            return false;
//        }

        return false;
    }


    private function genPasswordHash(string $password) {
        return \Yii::$app->security->generatePasswordHash($password);
    }
}