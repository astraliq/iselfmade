<?php

use yii\db\Migration;

/**
 * Class m201201_170427_alter_user
 */
class m201201_170427_alter_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'curators_email_repeat', $this->integer()->comment('Регулярность отправки отчетов на почту'));
        $this->addForeignKey('cur_email_rep_to_periods','users','curators_email_repeat','periods','id','restrict','restrict');
        $this->addColumn('users', 'curators_email_confirm', $this->integer()->comment('Подтверждение почты куратора'));
        $this->addColumn('users', 'curators_access_token', $this->string(255)->comment('Токен подтверждения почты куратора'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('cur_email_rep_to_periods','users');
        $this->dropColumn('users', 'curators_email_repeat');
        $this->dropColumn('users', 'curators_email_confirm');
        $this->dropColumn('users', 'curators_access_token');

    }
}
