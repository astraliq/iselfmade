<?php

use yii\db\Migration;

/**
 * Class m201004_062150_alter_tasks
 */
class m201004_062150_alter_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('mission_tasks', 'date_start', $this->timestamp()->comment('Дата старта')->defaultExpression('now()')->notNull()->after('date_create'));
//        $this->addColumn('mission_tasks', 'date_update', $this->timestamp()->comment('Дата изменения')->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')->after('date_start'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('mission_tasks', 'date_start');
//        $this->dropColumn('mission_tasks', 'date_update');
    }

}
