<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_grades".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property int $grade
 * @property string|null $comment
 * @property string|null $date_create
 * @property string|null $date_update
 *
 * @property Users $user
 */
class UsersGradesBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_grades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'date', 'grade'], 'required'],
            [['id', 'user_id', 'grade'], 'integer'],
            [['date', 'date_create', 'date_update'], 'safe'],
            [['comment'], 'string', 'max' => 255],
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
            'grade' => Yii::t('app', 'Grade'),
            'comment' => Yii::t('app', 'Comment'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
