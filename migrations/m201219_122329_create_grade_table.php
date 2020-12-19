<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%grade}}`.
 */
class m201219_122329_create_grade_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users_grades', [
            'id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'grade' => $this->integer(2)->notNull(),
            'comment' => $this->string(255)->defaultValue(null),
            'date_create' => $this->timestamp()->defaultExpression("now()"),
            'date_update' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
        $this->addPrimaryKey('user_id-date_pk', 'users_grades',['user_id','date']);
        $this->addForeignKey('grades_to_users','users_grades','user_id','users','id','restrict','restrict');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('grades_to_users','users_grades');
        $this->dropPrimaryKey('user_id-date_pk', 'users_grades');
        $this->dropTable('users_grades');
    }
}
