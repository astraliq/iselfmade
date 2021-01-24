<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210117_185006_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('report_comments', [
            'id' => $this->primaryKey(),
            'report_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'comment' => $this->string(255)->notNull(),
            'files' => $this->string(255)->defaultValue(null)->comment('список файлов через /'),
            'date_create' => $this->timestamp()->defaultExpression("now()"),
            'date_update' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'viewed' => $this->tinyInteger()->defaultValue(null)->comment('просмотрено 1-0'),
        ]);
        $this->addForeignKey('comments_to_users','report_comments','user_id','users','id','restrict','restrict');
        $this->addForeignKey('comments_to_reports','report_comments','report_id','users_reports','id','restrict','restrict');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('comments_to_reports','report_comments');
        $this->dropForeignKey('comments_to_users','report_comments');
        $this->dropTable('report_comments');
    }
}
