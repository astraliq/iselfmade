<?php

use yii\db\Migration;

/**
 * Class m201022_171110_alter_users_birthday
 */
class m201022_171110_alter_users_birthday extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('users', 'birthday', 'date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('users', 'birthday', 'timestamp');
    }
}
