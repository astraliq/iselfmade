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
 * @property string|null $curator_id
 * @property int|null $mentor_id id ментора
 * @property string|null $mentor_email
 * @property string|null $date_create
 * @property string|null $city Город нахождения
 * @property string|null $timezone Часовой пояс
 * @property int|null $offset_UTC Смещение времени от UTC
 * @property int|null $confirm_email Подтверждение почты
 * @property string|null $confirmation_token Подтверждающий почту токен
 * @property int|null $mentor_email_repeat Регулярность отправки отчетов на почту
 * @property int|null $mentor_email_confirm Подтверждение почты куратора
 * @property string|null $mentor_access_token Токен подтверждения почты куратора
 * @property string|null $grade_token Токен для установки оценок за выполнение задач
 *
 * @property MissionTasks[] $missionTasks
 * @property Periods $mentorEmailRepeat
 * @property UsersReports[] $usersGrades
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
            [['sex', 'group_id', 'mentor_id', 'offset_UTC', 'confirm_email', 'mentor_email_repeat', 'mentor_email_confirm'], 'integer'],
            [['birthday', 'date_create'], 'safe'],
            [['balance'], 'number'],
            [['email', 'phone_number', 'pass_hash', 'auth_key', 'access_token', 'name', 'surname', 'avatar', 'buddy_ids', 'curator_id', 'mentor_email', 'confirmation_token', 'mentor_access_token', 'grade_token'], 'string', 'max' => 255],
            [['city', 'timezone'], 'string', 'max' => 64],
            [['mentor_email_repeat'], 'exist', 'skipOnError' => true, 'targetClass' => Periods::className(), 'targetAttribute' => ['mentor_email_repeat' => 'id']],
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
            'curator_id' => Yii::t('app', 'Curator ID'),
            'mentor_id' => Yii::t('app', 'id ментора'),
            'mentor_email' => Yii::t('app', 'Mentor Email'),
            'date_create' => Yii::t('app', 'Date Create'),
            'city' => Yii::t('app', 'Город нахождения'),
            'timezone' => Yii::t('app', 'Часовой пояс'),
            'offset_UTC' => Yii::t('app', 'Смещение времени от UTC'),
            'confirm_email' => Yii::t('app', 'Подтверждение почты'),
            'confirmation_token' => Yii::t('app', 'Подтверждающий почту токен'),
            'mentor_email_repeat' => Yii::t('app', 'Регулярность отправки отчетов на почту'),
            'mentor_email_confirm' => Yii::t('app', 'Подтверждение почты куратора'),
            'mentor_access_token' => Yii::t('app', 'Токен подтверждения почты куратора'),
            'grade_token' => Yii::t('app', 'Токен для установки оценок за выполнение задач'),
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
     * Gets query for [[MentorEmailRepeat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMentorEmailRepeat()
    {
        return $this->hasOne(Periods::className(), ['id' => 'mentor_email_repeat']);
    }

    /**
     * Gets query for [[UsersReports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGrades()
    {
        return $this->hasMany(UsersReports::className(), ['user_id' => 'id']);
    }
}
