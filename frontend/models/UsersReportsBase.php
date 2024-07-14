<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users_reports".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property int|null $mentor_grade
 * @property string|null $comment
 * @property string|null $date_create
 * @property string|null $date_update
 * @property string|null $files список файлов через ;
 * @property int|null $self_grade личная оценка дня
 * @property int|null $status 1-ожидает,2-просмотрен,3-под вопросом,4-проверен
 * @property int|null $curator_grade оценка куратора
 * @property int|null $views количество просмотров отчета
 *
 * @property Users $user
 */
class UsersReportsBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'date'], 'required'],
            [['id', 'user_id', 'mentor_grade', 'self_grade', 'status', 'curator_grade', 'views'], 'integer'],
            [['date', 'date_create', 'date_update'], 'safe'],
            [['comment', 'files'], 'string', 'max' => 255],
            [['user_id', 'date'], 'unique', 'targetAttribute' => ['user_id', 'date']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'date' => Yii::t('app', 'Date'),
            'mentor_grade' => Yii::t('app', 'Mentor Grade'),
            'comment' => Yii::t('app', 'Comment'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
            'files' => Yii::t('app', 'список файлов через ;'),
            'self_grade' => Yii::t('app', 'личная оценка дня'),
            'status' => Yii::t('app', '1-ожидает,2-просмотрен,3-под вопросом,4-проверен'),
            'curator_grade' => Yii::t('app', 'оценка куратора'),
            'views' => Yii::t('app', 'количество просмотров отчета'),
        ];
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
