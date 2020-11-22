<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mission_tasks".
 *
 * @property int $id
 * @property int $user_id
 * @property int $private_id Приватность
 * @property int $type_id 1-Дело/2-Задача/3-Цель
 * @property int|null $cat_id Категория
 * @property int|null $aim_id Принадлежность к задаче
 * @property int|null $goal_id Принадлежность к целе
 * @property string $task ЗАДАЧА
 * @property string|null $main_img
 * @property string|null $buddy_ids Бадди - пользователи взявшие ответственность вместе с исполнителем
 * @property int|null $group_id ID группы поддержки
 * @property string|null $curators_ids Список id кураторов
 * @property string|null $curators_emails Список почт кураторов
 * @property string|null $hashtags Список хештегов через запятую
 * @property string|null $date_create
 * @property string $date_start Дата старта
 * @property string|null $date_finish Дата завершения (факт)
 * @property string|null $date_calculate Целевая дата завершения
 * @property int|null $finished 0-в работе,1-завершено
 * @property int|null $deleted 0-не удалено,1-удалено
 * @property int|null $repeat_type_id null-без повтора,1-ежедневно,2-раз в месяц,3-раз в год
 * @property string|null $secret_key
 * @property int|null $repeated_by_id Id повторяемой задачи
 * @property string|null $repeated_weekdays Id дней недели через запятую
 *
 * @property MissionCats $cat
 * @property SupportGroups $group
 * @property MissionPrivate $private
 * @property Periods $repeatType
 * @property MissionTypes $type
 * @property User $user
 */
class TasksBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mission_tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'task'], 'required'],
            [['id', 'user_id', 'private_id', 'type_id', 'cat_id', 'aim_id', 'goal_id', 'group_id', 'finished', 'deleted', 'repeat_type_id', 'repeated_by_id'], 'integer'],
            [['date_create', 'date_start', 'date_finish', 'date_calculate'], 'safe'],
            [['task', 'main_img', 'buddy_ids', 'curators_ids', 'curators_emails', 'hashtags', 'secret_key', 'repeated_weekdays'], 'string', 'max' => 255],
            [['id', 'user_id'], 'unique', 'targetAttribute' => ['id', 'user_id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => MissionCats::class, 'targetAttribute' => ['cat_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupportGroups::class, 'targetAttribute' => ['group_id' => 'id']],
            [['private_id'], 'exist', 'skipOnError' => true, 'targetClass' => MissionPrivate::class, 'targetAttribute' => ['private_id' => 'id']],
            [['repeat_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Periods::class, 'targetAttribute' => ['repeat_type_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MissionTypes::class, 'targetAttribute' => ['type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'private_id' => Yii::t('app', 'Приватность'),
            'type_id' => Yii::t('app', '1-Дело/2-Задача/3-Цель'),
            'cat_id' => Yii::t('app', 'Категория'),
            'aim_id' => Yii::t('app', 'Принадлежность к задаче'),
            'goal_id' => Yii::t('app', 'Принадлежность к целе'),
            'task' => Yii::t('app', 'ЗАДАЧА'),
            'main_img' => Yii::t('app', 'Main Img'),
            'buddy_ids' => Yii::t('app', 'Бадди - пользователи взявшие ответственность вместе с исполнителем'),
            'group_id' => Yii::t('app', 'ID группы поддержки'),
            'curators_ids' => Yii::t('app', 'Список id кураторов'),
            'curators_emails' => Yii::t('app', 'Список почт кураторов'),
            'hashtags' => Yii::t('app', 'Список хештегов через запятую'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_start' => Yii::t('app', 'Дата старта'),
            'date_finish' => Yii::t('app', 'Дата завершения (факт)'),
            'date_calculate' => Yii::t('app', 'Целевая дата завершения'),
            'finished' => Yii::t('app', '0-в работе,1-завершено'),
            'deleted' => Yii::t('app', '0-не удалено,1-удалено'),
            'repeat_type_id' => Yii::t('app', 'null-без повтора,1-ежедневно,2-раз в месяц,3-раз в год'),
            'secret_key' => Yii::t('app', 'Secret Key'),
            'repeated_by_id' => Yii::t('app', 'Id повторяемой задачи'),
            'repeated_weekdays' => Yii::t('app', 'Id дней недели через запятую'),
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(MissionCats::class, ['id' => 'cat_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(SupportGroups::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Private]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrivate()
    {
        return $this->hasOne(MissionPrivate::class, ['id' => 'private_id']);
    }

    /**
     * Gets query for [[RepeatType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRepeatType()
    {
        return $this->hasOne(Periods::class, ['id' => 'repeat_type_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(MissionTypes::class, ['id' => 'type_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
