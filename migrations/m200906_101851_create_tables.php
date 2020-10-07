<?php

use yii\db\Migration;

/**
 * Class m200906_101851_create_tables
 */
class m200906_101851_create_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'email' => $this->string(255)->notNull(),
            'phone_number' => $this->string(255),
            'pass_hash' => $this->string(255)->notNull(),
            'auth_key' => $this->string(255),
            'access_token' => $this->string(255),
            'name' => $this->string(255),
            'surname' => $this->string(255),
            'avatar' => $this->string(255),
//            'role_id' => $this->integer()->notNull()->defaultValue(2)->comment('1-Admin/2-Пользователь/3-Куратор/4-Модератор'),
            'sex' => $this->integer()->comment('1-муж/2-жен'),
            'birthday' => $this->timestamp(),
            'balance' => $this->decimal(10,2)->notNull()->defaultValue(0),
            'buddy_ids' => $this->string(255)->comment('Бадди - пользователи взявшие ответственность вместе с исполнителем'),
            'group_id' => $this->integer()->comment('ID группы поддержки'),
            'curators_ids' => $this->string(255),
            'curators_emails' => $this->string(255),
            'date_create' => $this->timestamp()->defaultExpression("now()"),
        ]);
//        $this->createTable('roles', [
//            'id' => $this->primaryKey(),
//            'title_ru' => $this->string(255)->notNull(),
//            'title_en' => $this->string(255)->notNull(),
//        ]);
        $this->createTable('mission_types', [
            'id' => $this->primaryKey(),
            'title_ru' => $this->string(255)->notNull(),
            'title_en' => $this->string(255)->notNull(),
            'period_id' => $this->integer()->notNull()->defaultValue(1)->comment('1-День/2-Месяц/3-Год'),
        ]);
        $this->createTable('periods', [
            'id' => $this->primaryKey(),
            'title_ru' => $this->string(255)->notNull(),
            'title_en' => $this->string(255)->notNull(),
        ]);
        $this->createTable('mission_private', [
            'id' => $this->primaryKey(),
            'title_ru' => $this->string(255)->notNull(),
            'title_en' => $this->string(255)->notNull(),
        ]);
        $this->createTable('mission_cats', [
            'id' => $this->primaryKey(),
            'title_ru' => $this->string(255)->notNull(),
            'title_en' => $this->string(255)->notNull(),
        ]);
        $this->createTable('mission_tasks', [
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
        ]);
        $this->addPrimaryKey('task_id-user_id_pk', 'mission_tasks',['id','user_id']);
        $this->createTable('support_groups', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'id_users' => $this->text()->notNull()->comment('Список id пользователей через запятую'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
//        $this->dropTable('roles');
        $this->dropTable('mission_types');
        $this->dropTable('periods');
        $this->dropTable('mission_private');
        $this->dropTable('mission_cats');
        $this->dropTable('mission_tasks');
        $this->dropPrimaryKey('task_id-user_id_pk', 'mission_tasks');
        $this->dropTable('support_groups');
    }

}
