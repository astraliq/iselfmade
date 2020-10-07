<?php

use yii\db\Migration;

/**
 * Class m201004_135109_alter_users
 */
class m201004_135109_alter_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'city', $this->string(64)->comment('Город нахождения'));
        $this->addColumn('users', 'timezone', $this->string(64)->comment('Часовой пояс'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'city');
        $this->dropColumn('users', 'timezone');
    }
}
