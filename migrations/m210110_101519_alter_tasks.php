<?php

use yii\db\Migration;

/**
 * Class m210110_101519_alter_tasks
 */
class m210110_101519_alter_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->dropForeignKey('tasks_to_groups','mission_tasks');
        $this->dropColumn('mission_tasks', 'group_id');
        $this->dropColumn('mission_tasks', 'curators_ids');
        $this->dropColumn('mission_tasks', 'curators_emails');
        $this->dropColumn('mission_tasks', 'buddy_ids');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->addColumn('mission_tasks', 'buddy_ids', $this->integer()->after('main_img'));
        $this->addColumn('mission_tasks', 'curators_emails', $this->integer()->after('main_img'));
        $this->addColumn('mission_tasks', 'curators_ids', $this->integer()->after('main_img'));
        $this->addColumn('mission_tasks', 'group_id', $this->integer()->after('main_img'));
        $this->addForeignKey('tasks_to_groups','mission_tasks','group_id','support_groups','id','restrict','restrict');
    }

}
