<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string|null $phone_number
 * @property string $pass_hash
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $avatar
 * @property int|null $sex null-неопределен/1-муж/2-жен
 * @property string|null $birthday
 * @property float $balance
 * @property string|null $buddy_ids Бадди - пользователи взявшие ответственность вместе с исполнителем
 * @property int|null $group_id ID группы поддержки
 * @property string|null $curators_ids
 * @property string|null $curators_emails
 * @property string|null $date_create
 * @property string|null $city Город нахождения
 * @property string|null $timezone Часовой пояс
 * @property int|null $offset_UTC Смещение времени от UTC
 * @property int|null $confirm_email Подтверждение почты
 * @property string|null $confirmation_token Подтверждающий почту токен
 * @property int|null $curators_email_repeat Регулярность отправки отчетов на почту
 * @property int|null $curators_email_confirm Подтверждение почты куратора
 * @property string|null $curators_access_token Токен подтверждения почты куратора
 *
 * @property MissionTasks[] $missionTasks
 * @property Periods $curatorsEmailRepeat
 */
class UserBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'pass_hash'], 'required'],
            [['sex', 'group_id', 'offset_UTC', 'confirm_email', 'curators_email_repeat', 'curators_email_confirm'], 'integer'],
            [['birthday', 'date_create'], 'safe'],
            [['balance'], 'number'],
            [['email', 'phone_number', 'pass_hash', 'auth_key', 'access_token', 'name', 'surname', 'avatar', 'buddy_ids', 'curators_ids', 'curators_emails', 'confirmation_token', 'curators_access_token'], 'string', 'max' => 255],
            [['city', 'timezone'], 'string', 'max' => 64],
            [['curators_email_repeat'], 'exist', 'skipOnError' => true, 'targetClass' => Periods::className(), 'targetAttribute' => ['curators_email_repeat' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'pass_hash' => Yii::t('app', 'Pass Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'avatar' => Yii::t('app', 'Avatar'),
            'sex' => Yii::t('app', 'null-неопределен/1-муж/2-жен'),
            'birthday' => Yii::t('app', 'Birthday'),
            'balance' => Yii::t('app', 'Balance'),
            'buddy_ids' => Yii::t('app', 'Бадди - пользователи взявшие ответственность вместе с исполнителем'),
            'group_id' => Yii::t('app', 'ID группы поддержки'),
            'curators_ids' => Yii::t('app', 'Curators Ids'),
            'curators_emails' => Yii::t('app', 'Curators Emails'),
            'date_create' => Yii::t('app', 'Date Create'),
            'city' => Yii::t('app', 'Город нахождения'),
            'timezone' => Yii::t('app', 'Часовой пояс'),
            'offset_UTC' => Yii::t('app', 'Смещение времени от UTC'),
            'confirm_email' => Yii::t('app', 'Подтверждение почты'),
            'confirmation_token' => Yii::t('app', 'Подтверждающий почту токен'),
            'curators_email_repeat' => Yii::t('app', 'Регулярность отправки отчетов на почту'),
            'curators_email_confirm' => Yii::t('app', 'Подтверждение почты куратора'),
            'curators_access_token' => Yii::t('app', 'Токен подтверждения почты куратора'),
        ];
    }

    /**
     * Gets query for [[MissionTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMissionTasks()
    {
        return $this->hasMany(MissionTasks::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CuratorsEmailRepeat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCuratorsEmailRepeat()
    {
        return $this->hasOne(Periods::className(), ['id' => 'curators_email_repeat']);
    }
}
