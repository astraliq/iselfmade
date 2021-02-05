<?php


namespace app\widgets\tasks;


use yii\base\Widget;

class RepeatSettingsWidget extends Widget {
    public $disableRepeatClass;
    public $disableRepeateAttr;
    public $disableRepeatTitle;
    public $repeatTypeSelect;
    public $weekdaysShowClass;
    public $weekdaysCheckedInputs;

    public function run() {
        return $this->render('repeatSettingsForm',[
            'disableRepeatClass' => $this->disableRepeatClass,
            'disableRepeateAttr' => $this->disableRepeateAttr,
            'disableRepeatTitle' => $this->disableRepeatTitle,
            'repeatTypeSelect' => $this->repeatTypeSelect,
            'weekdaysShowClass' => $this->weekdaysShowClass,
            'weekdaysCheckedInputs' => $this->weekdaysCheckedInputs,
        ]);
    }
}