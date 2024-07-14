<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "support_groups".
 *
 * @property int $id
 * @property string|null $title
 * @property string $id_users Список id пользователей через запятую
 *
 * @property MissionTasks[] $missionTasks
 */
class SupportGroupsBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_users'], 'required'],
            [['id_users'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'id_users' => Yii::t('app', 'Список id пользователей через запятую'),
        ];
    }

    /**
     * Gets query for [[MissionTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMissionTasks()
    {
        return $this->hasMany(MissionTasks::className(), ['group_id' => 'id']);
    }
}
