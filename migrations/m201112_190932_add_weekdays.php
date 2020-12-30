<?php

use yii\db\Migration;

/**
 * Class m201112_190932_add_weekdays
 */
class m201112_190932_add_weekdays extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('weekdays', [
            'id' => $this->primaryKey(),
            'title_ru' => $this->string(255)->notNull(),
            'title_en' => $this->string(255)->notNull(),
        ]);
        $this->batchInsert('weekdays',
            ['title_ru', 'title_en'], [
                ['Понедельник', 'Monday'],
                ['Вторник', 'Tuesday'],
                ['Среда', 'Wednesday'],
                ['Четверг', 'Thursday'],
                ['Пятница', 'Friday'],
                ['Суббота', 'Saturday'],
                ['Воскресенье', 'Sunday'],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('weekdays');
    }
}
