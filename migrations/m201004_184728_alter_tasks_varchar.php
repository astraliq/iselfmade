<?php

use yii\db\Migration;

/**
 * Class m201004_184728_alter_tasks_varchar
 */
class m201004_184728_alter_tasks_varchar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('mission_tasks', 'task');
        $this->addColumn('mission_tasks', 'date_start', $this->timestamp()->comment('Дата старта')->defaultExpression('now()')->notNull()->after('date_create'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('mission_tasks', 'date_start');
    }
}
