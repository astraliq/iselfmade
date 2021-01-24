<?php

use yii\db\Migration;

/**
 * Class m210110_093133_alter_users
 */
class m210110_093133_alter_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->renameColumn('users', 'curators_ids', 'curator_id');
        $this->renameColumn('users', 'curators_emails', 'mentor_email');
        $this->renameColumn('users', 'curators_email_repeat', 'mentor_email_repeat');
        $this->renameColumn('users', 'curators_email_confirm', 'mentor_email_confirm');
        $this->renameColumn('users', 'curators_access_token', 'mentor_access_token');
        $this->addColumn('users', 'mentor_id', $this->integer()->comment('id ментора')->after('curator_id'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->renameColumn('users', 'curator_id', 'curators_ids');
        $this->renameColumn('users', 'mentor_email', 'curators_emails');
        $this->renameColumn('users', 'mentor_email_repeat', 'curators_email_repeat');
        $this->renameColumn('users', 'mentor_email_confirm', 'curators_email_confirm');
        $this->renameColumn('users', 'mentor_access_token', 'curators_access_token');
        $this->dropColumn('users', 'mentor_id');


    }


}
