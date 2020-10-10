<?php

use yii\db\Migration;

/**
 * Class m201010_174904_add_table_archive
 */
class m201010_174904_add_table_archive extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('archive_tasks', [
            'id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'private_id' => $this->integer()->notNull()->defaultValue(1)->comment('Приватность'),
            'type_id' => $this->integer()->notNull()->defaultValue(1)
                ->comment('1-Дело/2-Задача/3-Цель'),
            'cat_id' => $this->integer()->comment('Категория'),
            'aim_id' => $this->integer()->comment('Принадлежность к задаче'),
            'goal_id' => $this->integer()->comment('Принадлежность к целе'),
            'task' => $this->string(255)->notNull()->comment('ЗАДАЧА'),
            'main_img' => $this->string(255),
            'buddy_ids' => $this->string(255)->comment('Бадди - пользователи взявшие ответственность вместе с исполнителем'),
            'group_id' => $this->integer()->comment('ID группы поддержки'),
            'curators_ids' => $this->string(255)->comment('Список id кураторов'),
            'curators_emails' => $this->string(255)->comment('Список почт кураторов'),
            'hashtags' => $this->string(255)->comment('Список хештегов через запятую'),
            'date_create' => $this->timestamp()->defaultExpression("now()"),
            'date_finish' => $this->timestamp()->comment('Дата завершения (факт)'),
            'date_calculate' => $this->timestamp()->comment('Целевая дата завершения'),
            'finished' => $this->integer()->defaultValue(0)->comment('0-в работе,1-завершено'),
            'deleted' => $this->integer()->defaultValue(0)->comment('0-не удалено,1-удалено'),
            'repeat_type_id' => $this->integer()->defaultValue(0)->comment('null-без повтора,1-ежедневно,2-раз в месяц,3-раз в год'),
        ], 'ENGINE=MyISAM');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('archive_tasks');
    }

}
