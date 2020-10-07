<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "periods".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 *
 * @property MissionTasks[] $missionTasks
 */
class PeriodsBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'periods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_en'], 'required'],
            [['title_ru', 'title_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'title_en' => Yii::t('app', 'Title En'),
        ];
    }

    /**
     * Gets query for [[MissionTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMissionTasks()
    {
        return $this->hasMany(MissionTasks::className(), ['repeat_type_id' => 'id']);
    }
}
