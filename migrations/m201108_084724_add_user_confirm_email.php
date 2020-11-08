<?php

use yii\db\Migration;

/**
 * Class m201108_084724_add_user_confirm_email
 */
class m201108_084724_add_user_confirm_email extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'confirm_email', $this->smallInteger()->defaultValue(0)->comment('Подтверждение почты'));
        $this->addColumn('users', 'confirmation_token', $this->string(255)->comment('Подтверждающий почту токен'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'confirm_email');
        $this->dropColumn('users', 'confirmation_token');
    }
}
