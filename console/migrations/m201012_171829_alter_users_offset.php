<?php

use yii\db\Migration;

/**
 * Class m201012_171829_alter_users_offset
 */
class m201012_171829_alter_users_offset extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'offset_UTC', $this->smallInteger()->comment('Смещение времени от UTC'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'offset_UTC');
    }
}
