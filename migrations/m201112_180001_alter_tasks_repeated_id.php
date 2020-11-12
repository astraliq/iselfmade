<?php

use yii\db\Migration;

/**
 * Class m201112_180001_alter_tasks_repeated_id
 */
class m201112_180001_alter_tasks_repeated_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('mission_tasks', 'repeated_by_id', $this->integer()->comment('Id повторяемой задачи'));
        $this->addColumn('mission_tasks', 'repeated_weekdays', $this->integer()->comment('Id дней недели через запятую'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('mission_tasks', 'repeated_by_id');
        $this->dropColumn('mission_tasks', 'repeated_weekdays');
    }
}
