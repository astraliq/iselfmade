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

        $user = $this->getUserByEmail($model->email);

        if ($user->access_token) {
            $user->access_token = null;
            $user->save();
        }

        if (!$this->validatePassword($model->password,$user->pass_hash)){
//            $model->addError('email', 'Неверная электронная почта или пароль');
            $model->addError('password', 'Неверная электронная почта или пароль.');
            return false;
        };

        return \Yii::$app->user->login($user,0);
    }

    public function validateSignIn(User $model) {
        $user = $this->getUserByEmail($model->email);
        if ($this->validatePassword($model->password,$user->pass_hash)) {
            return true;
        }
        return false;
    }

    private function validatePassword($password, $pass_hash) {
        return \Yii::$app->security->validatePassword($password, $pass_hash);
    }

    private function getUserByEmail($email){
        return User::find()->andWhere(['email'=>$email])->one();
    }

    public function sendRecoveryPassEmail(User $model) :bool {
        $user = new User();
        $user = $user->findIdentityByEmail($model->email);
        $token = $this->generateAccessTokenRestorePass();
        $user->access_token = $token;
        if ($user->save()) {
            $message = \Yii::$app->mailer->compose('remind_pass',[
                'token' => $token,
                'email' => $user->email,
                'username' => $user->name,
            ])
                ->setFrom('hello@iselfmade.ru')
                ->setTo($user->email)
                ->setSubject('iselfmade - Восстановление пароля')
                ->send();
        } else {
            return false;
        }

        return true;
    }

    public function sendConfirmationMail(User $model) :bool {
        $user = new User();
        $user = $user->findIdentityByEmail($model->email);
        if ($user->confirm_email == 0) {
            $confirmation_token = $this->generateConfirmationEmailToken();
            $user->confirmation_token = $confirmation_token;
            if ($user->save()) {
                $message = \Yii::$app->mailer->compose(
                    'confirm_email', [
                    'confirmation_token' => $confirmation_token,
                    'email' => $user->email,
                ]
                )
                    ->setFrom('hello@iselfmade.ru')
                    ->setTo($user->email)
                    ->setSubject('iselfmade - Подтверждение электронной почты')
                    ->send();
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function updatePassword(User $model) :bool {
        $user = new User();
        $user = $user->getUserByEmailAndToken($model->email, $model->token);
        $user->pass_hash = $this->genPasswordHash($model->password);
        $user->access_token = null;
        if ($user->save()) {
            return true;
        }
        return false;
    }

    public function confirmEmail(User $model) :bool {
        $user = new User();
        $user = $user->getUserByEmailAndConfirmToken($model->email, $model->confirmation_token);
        if ($user) {
            $user->confirmation_token = null;
            $user->confirm_email = 1;
            if ($user->save()) {
                return true;
            }
        }
        return false;
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

    private function generateAccessTokenRestorePass() {
        return \Yii::$app->security->generateRandomString(8);
    }

    public function generateConfirmationEmailToken() {
        return \Yii::$app->security->generateRandomString(12);
    }

    public function generateUserGradeToken() {
        return \Yii::$app->security->generateRandomString(8);
    }

    private function genPasswordHash(string $password) {
        return \Yii::$app->security->generatePasswordHash($password);
    }
}