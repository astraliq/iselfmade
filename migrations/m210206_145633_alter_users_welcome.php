<?php

use yii\db\Migration;

/**
 * Class m210206_145633_alter_users_welcome
 */
class m210206_145633_alter_users_welcome extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('users', 'welcome_view', $this->tinyInteger()->defaultValue(0)->comment('флаг просмотра welcome страницы'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('users','welcome_view');
    }
}
