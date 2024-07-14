<?php

use yii\db\Migration;

/**
 * Class m200908_180149_add_foreign_keys
 */
class m200908_180149_add_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('tasks_to_users','mission_tasks','user_id','users','id','restrict','restrict');
        $this->addForeignKey('tasks_to_privates','mission_tasks','private_id','mission_private','id','restrict','restrict');
        $this->addForeignKey('tasks_to_cats','mission_tasks','cat_id','mission_cats','id','restrict','restrict');
        $this->addForeignKey('tasks_to_types','mission_tasks','type_id','mission_types','id','restrict','restrict');
        $this->addForeignKey('tasks_to_groups','mission_tasks','group_id','support_groups','id','restrict','restrict');
        $this->addForeignKey('tasks_to_repeat_types','mission_tasks','repeat_type_id','periods','id','restrict','restrict');

        $this->addForeignKey('types_to_periods','mission_types','period_id','periods','id','restrict','restrict');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('tasks_to_users','mission_tasks');
        $this->dropForeignKey('tasks_to_privates','mission_tasks');
        $this->dropForeignKey('tasks_to_cats','mission_tasks');
        $this->dropForeignKey('tasks_to_types','mission_tasks');
        $this->dropForeignKey('tasks_to_groups','mission_tasks');
        $this->dropForeignKey('tasks_to_repeat_types','mission_tasks');

        $this->dropForeignKey('types_to_periods','mission_types');

    }
}
