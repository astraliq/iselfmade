<?php

use yii\db\Migration;

/**
 * Class m200927_071710_alter_tasks
 */
class m200927_071710_alter_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('mission_tasks', 'secret_key', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('mission_tasks', 'secret_key');
    }

}
