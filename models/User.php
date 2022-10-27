<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 * @property Task[] $tasks
 */
class User extends UserBase implements IdentityInterface
{
    public $password;
    public $repeat_password;
    public $token;
    public $avaReal;
    public $timezoneKeyNumber;

    CONST DAY = 1;
    CONST WEEK = 5;
    CONST REPEAT_CURATOR = [self::DAY=> 'Каждый день', self::WEEK=> 'Раз в неделю'];


    CONST MALE = 1;
    CONST FEMALE = 2;
    CONST SEX = [self::MALE => 'Мужской', self::FEMALE => 'Женский'];

    private const SCENARIO_SIGN_UP = 'signUp';
    private const SCENARIO_CONFIRM_EMAIL = 'confirmationEmail';
    private const SCENARIO_VALIDATE_SIGN_UP = 'validateSignUp';
    private const SCENARIO_SIGN_IN = 'signIn';
    private const SCENARIO_VALIDATE_SIGN_IN = 'validateSignIn';
    private const SCENARIO_REMIND = 'remindPass';
    private const SCENARIO_RESTORE = 'restorePass';
    private const SCENARIO_UPD_PSW = 'updateWithPassword';
    private const SCENARIO_CONFIRM_MENTOR_EMAIL = 'confirmationCuratorsEmail';

    public function scenarioSignUp(){
        $this->scenario = self::SCENARIO_SIGN_UP;
    }

    public function scenarioSignIn(){
        $this->scenario = self::SCENARIO_SIGN_IN;
    }

    public function scenarioUpdateWithPass(){
        $this->scenario = self::SCENARIO_UPD_PSW;
    }

    public function scenarios() {
        return [
            self::SCENARIO_SIGN_UP => ['email', 'password', 'repeat_password'],
            self::SCENARIO_CONFIRM_EMAIL => ['email', 'confirmation_token'],
            self::SCENARIO_CONFIRM_MENTOR_EMAIL => ['mentor_email', 'mentor_access_token', 'mentor_email_confirm'],
            self::SCENARIO_VALIDATE_SIGN_UP => ['email', 'password', 'repeat_password'],
            self::SCENARIO_SIGN_IN => ['email', 'password'],
            self::SCENARIO_VALIDATE_SIGN_IN => ['email', 'password'],
            self::SCENARIO_REMIND => ['email'],
            self::SCENARIO_RESTORE => ['email', 'token', 'password', 'repeat_password'],
            self::SCENARIO_UPD_PSW => ['password', 'repeat_password', 'name', 'surname', 'phone_number', 'timezone', 'avaReal', 'sex', 'birthday', 'offset_UTC', 'mentor_email', 'mentor_email_repeat'],
            'default' => ['name', 'surname', 'phone_number', 'timezone', 'avaReal', 'sex', 'birthday', 'offset_UTC', 'mentor_email', 'mentor_email_repeat']
        ];
    }



    public function beforeValidate() {
        // найтройки часового пояса по умолчанию
        if (!$this->timezone) {
            $this->timezone = 'Europe/Moscow';
            $this->offset_UTC = 3;
        }
        // форматирование даты рождения
        if (!empty($this->birthday)){
            $date = \DateTime::createFromFormat('d.m.Y', $this->birthday);
            if ($date) {
                $this->birthday = $date->format('Y-m-d');
            }
        }
        if (is_numeric($this->timezone)) {
            $this->timezone = \Yii::$app->timezones->getRuTimezones('short')[$this->timezone];
            $this->offset_UTC = \Yii::$app->timezones->getOffsetTimezone($this->timezone);
        }

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function rules()
    {
        return array_merge([
            ['birthday', 'date', 'format' => 'php:Y-m-d'],
            ['avaReal','file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'png', 'jpeg'], 'maxSize'=>1024 * 1024 * 2, 'tooBig'=> 'Максимальный размер картинки 2MB'],
            ['password', 'required', 'when'  => function () {
                return $this->email != '';
            },'message' => 'Необходимо заполнить пароль'],
            [['email'], 'required','on'=> [self::SCENARIO_SIGN_UP, self::SCENARIO_REMIND, self::SCENARIO_CONFIRM_EMAIL], 'message' => 'Необходимо заполнить электронную почту'],
            [['password'], 'required','on'=> [self::SCENARIO_SIGN_UP, self::SCENARIO_RESTORE], 'message' => 'Необходимо заполнить пароль'],
            [['email','password'], 'required','message' => 'Необходимо заполнить электронную почту и пароль'],
//            ['password', 'string','on'=> self::SCENARIO_SIGN_UP, 'min' => 8, 'max' => 250, 'message' => 'Пароль должен содержать минимум 8 символов'],
//            ['password', 'match','pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message'        => 'Пароль должен содержать латинские буквы минимум 1 строчную, 1 заглавную и 1 цифру', 'on'=> self::SCENARIO_SIGN_UP],
            ['repeat_password', 'compare', 'compareAttribute' => 'password','on'=> [self::SCENARIO_SIGN_UP, self::SCENARIO_UPD_PSW, self::SCENARIO_RESTORE], 'message' => 'Пароли должны совпадать'],
            ['repeat_password', 'required', 'message' => 'Необходимо повторить пароль'],
            ['token', 'required', 'message' => 'Необходимо ввести код подтверждения'],
            ['confirmation_token', 'required', 'on'=> [self::SCENARIO_CONFIRM_EMAIL], 'message' => 'Необходимо ввести код подтверждения электронной почты'],
            ['token', 'checkToken', 'on'=> [self::SCENARIO_RESTORE], 'message' => 'Код подтверждения не совпадает с отправленным.'],
            [['email'], 'unique','on'=> self::SCENARIO_SIGN_UP, 'message' => 'Такой адрес уже зарегистрирован'],
            [['email'], 'validateEmail','on'=> [self::SCENARIO_SIGN_IN, self::SCENARIO_RESTORE]],
            [['email'], 'findEmail','on'=> self::SCENARIO_REMIND],
            [['password'], 'validateEmailByPass','on'=> self::SCENARIO_SIGN_IN],
            [['password'], 'validatePassword','on'=> self::SCENARIO_SIGN_IN],
            ['sex', 'in', 'range' => array_keys(self::SEX)],
            ['timezone', 'validateTimezone', 'message' => 'Неверное имя часового пояса'],
            ['mentor_email_repeat', 'in', 'range' => array_keys(self::REPEAT_CURATOR)],
            ['mentor_email', 'email', 'message' => 'Введенное значение не является правильным email адресом.'],
        ], parent::rules());
    }

    public function afterFind() {
        $this->timezoneKeyNumber = array_search($this->timezone, \Yii::$app->timezones->getRuTimezones('short'));
//        if (!$this->avatar) {
//            $this->avatar = '/img/user_img.jpg';
//        }

        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function afterValidate() {
        $userFind = $this->findOne(['id' => $this->id]);
        if ($userFind) {
            if ($userFind->mentor_email !== $this->mentor_email) {
                $this->mentor_email_confirm = null;
                $this->mentor_access_token = null;
            }
        }
        parent::afterValidate(); // TODO: Change the autogenerated stub
    }


    public function beforeSave($insert) {
        if (!$this->mentor_email_repeat) {
            $this->mentor_email_repeat = 1;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }


    public function checkToken() {
        $user = User::getUserByEmailAndToken($this->email, $this->token);
        if (!$user) {
            $this->addError('token', 'Код подтверждения не совпадает с отправленным.');
        }
    }

    public function validateEmail() {
        $user = User::getUserByEmail($this->email);
        if (!$user) {
            $this->addError('email', 'Неверная электронная почта или пароль.');
            $this->addError('password', 'Неверная электронная почта или пароль.');
        }
    }

    public function findEmail() {
        if (!$this->getUserByEmail($this->email)) {
            $this->addError('email', 'Пользователь с такой почтой не зарегестрирован');
        }
    }

    public function validateEmailByPass() {
        if (!$this->email) {
            $this->addError('password', 'Необходимо заполнить электронную почту');
        }
    }

    public function validatePassword() {
        $auth = \Yii::$app->auth;
        if (!$auth->validateSignIn($this)) {
            $this->addError('email', 'Неверная электронная почта или пароль.');
            $this->addError('password', 'Неверная электронная почта или пароль.');
        }
    }

    public function validateTimezone() {
        $timezones = \Yii::$app->timezones->getRuTimezones('short');
        if (!array_search($this->timezone, $timezones)) {
            $this->addError('timezone', 'Неверное имя часового пояса');
        }
    }

    public function getUserEmail($id) {
        $user = $this->findIdentity($id);
        return $user->email;
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return User::find()->andWhere(['id' => $id])->one();
    }

    public static function findIdentityByEmail($email) {
        return User::find()->andWhere(['email' => $email])->one();
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function getUserByEmail($email) {
        return User::find()->andWhere(['email'=>$email])->one();
    }

    public static function getUserByEmailAndToken($email, $token) {
        return User::find()->andWhere(['email'=>$email,'access_token'=>$token])->one();
    }

    public static function getUserByEmailAndConfirmToken($email, $confirmation_token) {
        return User::find()->andWhere(['email'=>$email,'confirmation_token'=>$confirmation_token])->one();
    }

    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int|string current user email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return int|string current user timezone
     */
    public function getTimezone() {
        return $this->timezone;
    }

    /**
     * @return int|string current user avatar
     */
    public function getAvatarName() {
        return $this->avatar;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function fields()
    {
        return [
            'email' => $this->email,
            'pass_hash' => $this->passHash,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Имя'),
            'surname' => Yii::t('app', 'Фамилия'),
            'phone_number' => Yii::t('app', 'Номер телефона'),
            'sex' => Yii::t('app', 'Пол'),
            'city' => Yii::t('app', 'Город'),
            'birthday' => Yii::t('app', 'День рождения'),
            'email' => Yii::t('app', 'Электронная почта'),
            'avaReal' => Yii::t('app', 'Аватар'),
            'timezone' => Yii::t('app', 'Часовой пояс'),
            'password' => Yii::t('app', 'Пароль'),
            'repeat_password' => Yii::t('app', 'Повтор пароля'),
            'token' => Yii::t('app', 'Код подтверждения'),
            'mentor_email' => Yii::t('app', 'Электронная почта наставника'),
            'mentor_email_repeat' => Yii::t('app', 'Регулярность отправки отчетов на почту наставнику'),

        ]);
    }
}
