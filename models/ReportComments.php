<?php


namespace app\models;


class ReportComments extends ReportCommentsBase {

    public $uploadFiles;

    public function beforeValidate() {

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function rules() {

//        return array_merge([
//            [],
//        ],parent::rules()); // TODO: Change the autogenerated stub
        return parent::rules(); // TODO: Change the autogenerated stub
    }

    public function afterFind() {

        parent::afterFind(); // TODO: Change the autogenerated stub
    }


    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getReportr() {
        return $this->hasOne(UsersReports::class, ['id' => 'report_id']);
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels(); // TODO: Change the autogenerated stub
//        $labels['date_calculate'] = \Yii::t('app', 'Завершить:');
        return $labels;
    }

}