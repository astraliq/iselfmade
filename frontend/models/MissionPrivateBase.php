<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mission_private".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 *
 * @property Tasks[] $Tasks
 */
class MissionPrivateBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'mission_private';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title_ru', 'title_en'], 'required'],
            [['title_ru', 'title_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
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
    public function getMissionTasks(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Tasks::tableName(), ['private_id' => 'id']);
    }
}
