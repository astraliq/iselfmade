<?php

use yii\db\Migration;

/**
 * Class m200906_161458_add_items_to_tables
 */
class m200906_161458_add_items_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->batchInsert('roles',
//            ['title_ru', 'title_en'], [
//                ['Админ', 'Admin'],
//                ['Пользователь', 'User'],
//                ['Куратор', 'Curator'],
//                ['Модератор', 'Moderator']
//            ]);
        $this->batchInsert('periods',
            ['title_ru', 'title_en'], [
                ['День', 'Day'],
                ['Месяц', 'Month'],
                ['Год', 'Year'],
                ['Квартал', 'Quarter'],
                ['Неделя', 'Week'],
                ['По будням', 'Weekdays'],
            ]);
        $this->batchInsert('mission_types',
            ['title_ru', 'title_en','period_id'], [
                ['День', 'Day',1],
                ['Месяц', 'Month',2],
                ['Год', 'Year',3],
            ]);
        $this->batchInsert('mission_private',
            ['title_ru', 'title_en'], [
                ['Не приватная', 'No private'],
                ['Приватная', 'Private'],
            ]);

//        $this->insert('durations',[
//            'email' => 'test1@test.ru',
//            'passwordHash' => '1',
//        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->truncateTable('roles');
        $this->truncateTable('periods');
        $this->truncateTable('mission_types');
    }

}
