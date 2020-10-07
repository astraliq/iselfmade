<?php


namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model {
    public $email;
    public $password;
    public $repeat_password;

    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['repeat_password', 'validatePassword'],
            // пароли должны совпадать
            ['password', 'compare', 'compareAttribute' => 'repeat_password'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный e-mail или пароль.');
            }
        }
    }

    /**
     * Register a user using the provided email and password.
     * @return bool whether the user is register in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }



}