<?php


namespace frontend\models;


class UsersReports extends UsersReportsBase {

    public $uploadFiles;

    public function beforeValidate() {
        if (!$this->status) {
            $this->status = 1;
        }
        if (!$this->id) {
            $max = $this->find()
                ->max('id');
            if (!$max) {
                $this->id = 1;
            } else {
                $this->id = ++$max;
            }
        }

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function rules() {

        return array_merge([
            [['uploadFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg'], 'maxFiles' => 5, 'maxSize' => 1024 * 1024 * 2, 'tooBig'=> 'Максимальный размер файла 2MB'],
            ['self_grade', 'integer', 'min'=>1, 'max'=>10, 'message' => 'Оцените свой день.', 'tooBig' => 'Оцените свой день.', 'tooSmall' => 'Оцените свой день.']
        ],parent::rules()); // TODO: Change the autogenerated stub
    }



    public function attributeLabels() {
        $labels = parent::attributeLabels(); // TODO: Change the autogenerated stub
//        $labels['date_calculate'] = \Yii::t('app', 'Завершить:');
        return $labels;
    }
}