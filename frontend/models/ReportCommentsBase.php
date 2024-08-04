<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "report_comments".
 *
 * @property int $id
 * @property int $report_id
 * @property int $user_id
 * @property string $comment
 * @property string|null $files список файлов через /
 * @property string|null $date_create
 * @property string|null $date_update
 * @property int|null $viewed просмотрено 1-0
 *
 * @property UsersReports $report
 * @property Users $user
 */
class ReportCommentsBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['report_id', 'user_id', 'comment'], 'required'],
            [['report_id', 'user_id', 'viewed'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['comment', 'files'], 'string', 'max' => 255],
            [['report_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersReports::className(), 'targetAttribute' => ['report_id' => 'id']],
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
            'report_id' => Yii::t('app', 'Report ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'comment' => Yii::t('app', 'Comment'),
            'files' => Yii::t('app', 'список файлов через /'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
            'viewed' => Yii::t('app', 'просмотрено 1-0'),
        ];
    }

    /**
     * Gets query for [[Report]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReport()
    {
        return $this->hasOne(UsersReports::className(), ['id' => 'report_id']);
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
