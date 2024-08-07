<?php

namespace frontend\models;

use common\models\User;
use frontend\components\EncryptComponent;
use Yii;

class Tasks extends TasksBase {

    public $filesReal;
    public $date_create_view;
    public $date_calculate_view;
    public $nextPeriod;
    public $parent_repeat_type;
    public $parent_repeated_weekdays;
    public $nextRepeatDate;
    public $add_by_repeat = false;

    const TASK = 1;
    const AIM = 2;
    const GOAL = 3;
    const TYPE_TASK = [self::TASK => 'Дело', self::AIM => 'Задача', self::GOAL => 'Цель', ];
    const NO_PRIVATE = 1;
//    const ONLY_BUDDY = 2;
//    const ONLY_CURATOR = 3;
    const PRIVATE = 2;
    const TASK_PRIVATE = [self::NO_PRIVATE => 'Видна всем', self::PRIVATE => 'Видна только мне',];

    public function getConstants() {
        return [
            'TASK' => self::TASK,
            'AIM' => self::AIM,
            'GOAL' => self::GOAL,
            'TYPE_TASK' => self::TYPE_TASK,
            'NO_PRIVATE' => self::NO_PRIVATE,
//            'ONLY_BUDDY' => self::ONLY_BUDDY,
//            'ONLY_CURATOR' => self::ONLY_CURATOR,
            'PRIVATE' => self::PRIVATE,
            'TASK_PRIVATE' => self::TASK_PRIVATE,
        ];
    }


    public function afterFind() {
        parent::afterFind();

        if (\Yii::$app instanceof yii\console\Application || \Yii::$app->controller->route === 'crone/repeat-tasks') {
            $user_id = $this->user_id;
        } else {
            $user_id = \Yii::$app->user->getId();
        }

        $this->date_create_view = \Yii::$app->formatter->asDateTime($this->date_create, 'php:d F Y, H:i:s');
        $this->date_calculate_view = \Yii::$app->formatter->asDateTime($this->date_calculate, 'php:d F Y, H:i:s');

        // расшифровка задачи
        if ($this->private_id == self::PRIVATE) {
            $user = new User();
            $this->task = \Yii::$app->encrypt->expandData($this->task, $user->getUserEmail($user_id), $this->user_id, $this->secret_key, $this->id);
        }

        // если задача повторная, то берем основные атрибуты от родителя
        if ($this->repeated_by_id) {

            $parentTask = Tasks::find()
                ->where([
                    'user_id' => $user_id,
                    'id' => $this->repeated_by_id,
                ])
                ->one();
            $this->parent_repeat_type = $parentTask->repeat_type_id;
            $this->parent_repeated_weekdays = $parentTask->repeated_weekdays;
//            $this->private_id = $parentTask->private_id;
//            $this->task = $parentTask->task;
        }

    }


    public function beforeValidate() {
        if (!empty($this->date_calculate)){
            $date = \DateTime::createFromFormat('d.m.Y', $this->date_calculate);
            if ($date) {
                $this->date_calculate = $date->format('Y-m-d');
            }
        }
        if (empty($this->type_id)){
            $this->type_id = 1;
        }
        if (empty($this->hashtags)){
            $this->hashtags = null;
        }
        $this->repeat_start = $this->repeat_start === 'При создании' ? $this->date_start : $this->repeat_start;

        if (!$this->repeat_type_id) {
            switch ($this->type_id) {
                case 1: // если тип задачи - дело
                    if ($this->nextPeriod == 1) { // если задача на следующий период
                        $addPeriod = strtotime("+1 day");
                        $this->date_start = date('Y-m-d', $addPeriod) . ' 00:00:00';
                        $this->date_calculate = date('Y-m-d', $addPeriod) . ' 23:59:59';
                    } else {
                        if (!$this->date_calculate) {
                            $this->date_calculate = date('Y-m-d') . ' 23:59:59';
                        }
                    }
                    break;
                case 2:
                    if ($this->nextPeriod == 1) {
                        $addPeriod = strtotime("+1 month");
                        $this->date_start = date('Y-m-d', $addPeriod) . ' 00:00:00';
                        $this->date_calculate = (new \DateTime(date('t', time()).'.'.date('m.Y', $addPeriod) . ' 23:59:59'))->format('Y-m-d H:i:s');
                    } else {
                        if (!$this->date_calculate) {
                            $this->date_calculate =
                                (new \DateTime(date('t', time()) . '.' . date('m.Y') . ' 23:59:59'))->format('Y-m-d H:i:s');
                        }
                    }
                    break;
                case 3:
                    if ($this->nextPeriod == 1) {
                        $addPeriod = strtotime("+1 year");
                        $this->date_start = date('Y-m-d', $addPeriod) . ' 00:00:00';
                        $this->date_calculate = (new \DateTime(date('31.12.'.date('Y', $addPeriod)) . ' 23:59:59'))->format('Y-m-d H:i:s');
                    } else {
                        if (!$this->date_calculate) {
                            $this->date_calculate =
                                (new \DateTime(date('31.12.' . date('Y')) . ' 23:59:59'))->format('Y-m-d H:i:s');
                        }
                    }
                    break;
            }
        } else {
            switch ($this->repeat_type_id) {
                case 1: // everyday
                case 2: // month
                case 3: // month
                case 4: // quarter
                case 5: // week
                case 6: // work days
                case 7: // holidays
                case 8: // weekdays
                    if ($this->repeat_start) {
                        $this->date_start = date('Y-m-d', strtotime($this->repeat_start)) . ' 00:00:00';
                        $this->date_calculate = date('Y-m-d', strtotime($this->repeat_start)) . ' 23:59:59';
                    } else {
                        $this->date_start = $this->date_create;
                        $this->date_calculate = date('Y-m-d', strtotime($this->date_start)) . ' 23:59:59';
                    }
                    break;
//                case 6: // work days
//                    if (!$this->date_create) {
//                        $dCreate = date('Y-m-d');
//                    } else {
//                        $dCreate = $this->date_create;
//                    }
//                    if ($this->repeat_start) {
//                        $nextDate = \Yii::$app->components->task->getNextWorkday($this->repeat_start);
//                        $this->date_start = date('Y-m-d', $nextDate) . ' 00:00:00';
//                        $this->date_calculate = date('Y-m-d', $nextDate) . ' 23:59:59';
//                    } else {
//                        $this->date_start = date('Y-m-d') . ' 00:00:00';
//                        $this->date_calculate = date('Y-m-d') . ' 23:59:59';
//                    }
//                    break;
                default:
                    if ($this->nextPeriod == 1) {
                        $addPeriod = strtotime("+1 day");
                        $this->date_start = date('Y-m-d', $addPeriod) . ' 00:00:00';
                        $this->date_calculate = date('Y-m-d', $addPeriod) . ' 23:59:59';
                    } else {
                        if (!$this->date_calculate) {
                            $this->date_calculate = date('Y-m-d') . ' 23:59:59';
                        }
                    }
            }
        }

        if (\Yii::$app instanceof yii\console\Application || $this->add_by_repeat) {
            $user_id = $this->user_id;
        } else {
            $user_id = \Yii::$app->user->getId();
        }

        if (!$this->id) {
            $max = $this->find()
                ->andWhere(['user_id' => $user_id])
                ->max('id');
            if (!$max) {
                $this->id = 1;
            } else {
                $this->id = ++$max;
            }
        }

        if (!$this->deleted) {
            $this->deleted = 0;
        }
        if (!$this->finished) {
            $this->finished = 0;
        }

        $this->repeat_end = $this->repeat_end === 'Бессрочно' ? null : $this->repeat_end;
        $this->repeat_created = $this->repeat_created == 0 ? null : $this->repeat_created;

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function afterValidate() {

        if ($this->type_id == 2) {
            $this->aim_id = null;
        }

        if ($this->type_id == 3) {
            $this->aim_id = null;
            $this->goal_id= null;
        }

        parent::afterValidate(); // TODO: Change the autogenerated stub
    }


    public function beforeSave($insert) {
        if (\Yii::$app instanceof yii\console\Application || $this->add_by_repeat) {
            $user_id = $this->user_id;
        } else {
            $user_id = \Yii::$app->user->getId();
        }

        // если задача повторная, то присваиваем изменения родителю
        if ($this->repeated_by_id) {
//            $parentTask = Tasks::find()
//                ->where([
//                    'user_id' => $user_id,
//                    'id' => $this->repeated_by_id,
//                ])
//                ->one();
//
//            $parentTask->repeat_type_id = $this->repeat_type_id;
//            $parentTask->repeated_weekdays = $this->repeated_weekdays;
//            $parentTask->task = $this->task;
//            $parentTask->private_id = $this->private_id;
//            // сохраняем изменения без валидации
//            $parentTask->save(false);
            $this->repeat_type_id = null;
        }

        // изменяем все подобные задачи за текущий и будущие периоды, кроме прошедших
//        if ($this->repeated_by_id) {
//            $alreadyRepeatedTasks = Tasks::find()
//                ->where([
//                    'user_id' => $user_id,
//                    'repeat_type_id' => null,
//                    'repeated_by_id' => $this->repeated_by_id,
//                ])
//                ->andWhere(['not', ['id' => $this->id]])
//                ->andWhere(['AND',
//                ['>=', 'date_start', (new \DateTime(date('d.m.Y')  . ' 00:00:00'))->format('Y-m-d H:i:s')]
//                ])
//                ->orderBy(['date_create' => SORT_ASC])
//                ->all();
//
//            foreach ($alreadyRepeatedTasks as $alreadyRepeatedTask) {
//                $alreadyRepeatedTask->repeat_type_id = $this->repeat_type_id;
//                $alreadyRepeatedTask->task =  $this->task;
//                $alreadyRepeatedTask->private_id = $this->private_id;
//            }
//            \Yii::$app->dao->updateUserTasks($alreadyRepeatedTasks);
//        }

        // шифруем задачу
        if ($this->private_id == self::PRIVATE) {
            $user = new User();
            $this->secret_key = \Yii::$app->encrypt->genFalseKey();
            $this->task = \Yii::$app->encrypt->encryptData($this->task, $user->getUserEmail($user_id), $this->user_id, $this->secret_key, $this->id);
        } else {
            $this->secret_key = null;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

//    public static function primaryKey() {
//        return 'id';
//    }

    public function afterSave($insert, $changedAttributes) {
        $this->date_create_view = Yii::$app->formatter->asDateTime($this->date_create, 'php:d F Y H:i:s');
        $this->date_calculate_view = Yii::$app->formatter->asDateTime($this->date_calculate, 'php:d F Y H:i:s');
        return parent::afterSave($insert, $changedAttributes);
    }


    public function rules() {

        return array_merge([
            ['type_id', 'in', 'range' => array_keys(self::TYPE_TASK)],
            [['task'], 'trim'],
            [['task'],'required'],
            ['task','string','min' => 2,'max' => 250],
//            [['private_id','repeat_type_id'],'integer'],
            ['private_id', 'in', 'range' => array_keys(self::TASK_PRIVATE)],
            ['date_calculate', 'date', 'format' => 'php: Y-m-d H:i:s'],
            [['nextPeriod', 'date_create_view', 'date_calculate_view', 'parent_repeat_type', 'parent_repeated_weekdays'], 'safe'],
            ['repeat_start', 'repeatDateStartCheck'],
            ['repeat_end', 'repeatDateEndCheck'],
            ['repeat_created', 'checkRepeatCreated'],
//            ['aim_id', 'value' => null, 'when' => function($model) {
//                return !$model->type_id == 1 || !$model->type_id == 2;
//            }],
//            ['goal_id', 'value' => null, 'when' => function($model) {
//                return !$model->type_id == 2;
//            }],
//            [['email','files'], 'default', 'value' => null],
//            ['file','file', 'extensions' => ['jpg', 'png', 'jpeg']],
        ],parent::rules()); // TODO: Change the autogenerated stub
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels(); // TODO: Change the autogenerated stub
        $labels['type_id'] = \Yii::t('app', 'Тип задачи');
        $labels['task'] = \Yii::t('app', 'Сделать:');
        $labels['hashtags'] = \Yii::t('app', 'Список хештегов через пробел:');
        $labels['date_calculate'] = \Yii::t('app', 'Завершить:');
        return $labels;
    }

    public function checkRepeatCreated():bool {
        if ($this->repeat_created == 1) {
            if (!$this->repeat_type_id) {
                $this->addError('repeat_created', 'Задача должна повторяться.');
                return false;
            }
        }
        return true;
    }

    public function repeatDateStartCheck():bool {
        if (!$this->repeat_start) {
            return true;
        }
        if (strtotime($this->repeat_start) > strtotime($this->repeat_end) && $this->repeat_end) {
            $this->addError('repeat_start', 'Дата окончания не может быть раньше даты начала повтора.');
            return false;
        }
        if (strtotime($this->repeat_start) < strtotime(date('d.m.Y', strtotime($this->date_create)))) {
            $this->addError('repeat_start', 'Дата окончания не может быть раньше даты создания.');
            return false;
        }
        return true;
    }

    public function repeatDateEndCheck():bool {
        if (!$this->repeat_end) {
            return true;
        }
        if (strtotime($this->repeat_end) <= strtotime(date('Y-m-d'))) {
            $this->addError('repeat_end', 'Дата окончания не может быть раньше текущей даты.');
            return false;
        }
        if (strtotime($this->repeat_start) > strtotime($this->repeat_end)  && $this->repeat_start) {
            $this->addError('repeat_end', 'Дата окончания не может быть раньше даты начала повтора.');
            return false;
        }
        return true;
    }

}
