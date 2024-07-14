<?php


namespace frontend\components\widgets\tasks;


use yii\base\Widget;

class RepeatSettingsWidget extends Widget {
    public $task;
    public $disableRepeatClass;
    public $disableRepeateAttr;
    public $disableRepeatTitle;
    public $repeatTypeSelect;
    public $weekdaysShowClass;
    public $repeatDatesShowClass;
    public $weekdaysCheckedInputs;
    public $repeat_created;

    public function run() {
        return $this->render('repeatSettingsForm', [
            'task' => $this->task,
            'disableRepeatClass' => $this->disableRepeatClass,
            'disableRepeateAttr' => $this->disableRepeateAttr,
            'disableRepeatTitle' => $this->disableRepeatTitle,
            'repeatTypeSelect' => $this->repeatTypeSelect,
            'weekdaysShowClass' => $this->weekdaysShowClass,
            'repeatDatesShowClass' => $this->repeatDatesShowClass,
            'weekdaysCheckedInputs' => $this->weekdaysCheckedInputs,
            'repeat_created' => $this->repeat_created,
        ]);
    }
}