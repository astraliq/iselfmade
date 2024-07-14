<?php

use yii\db\Migration;

/**
 * Class m201112_185230_add_items
 */
class m201112_185230_add_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('tasks_to_repeat_types','mission_tasks');
        $this->dropForeignKey('types_to_periods','mission_types');
        $this->truncateTable('periods');
        $this->batchInsert('periods',
            ['title_ru', 'title_en'], [
                ['Ежедневно', 'Everyday'],
                ['Раз в месяц', 'Once a month'],
                ['Раз в год', 'Once a year'],
                ['Раз в квартал', 'Once a quarter'],
                ['Раз в неделю', 'Once a week'],
                ['По будням', 'On weekdays'],
                ['По выходным', 'On weekends'],
                ['По дням недели', 'By days of week'],
            ]);
        $this->addForeignKey('tasks_to_repeat_types','mission_tasks','repeat_type_id','periods','id','restrict','restrict');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->delete('periods', ['title_ru' => 'По дням недели']);
        $this->dropForeignKey('tasks_to_repeat_types','mission_tasks');
        $this->truncateTable('periods');
        $this->batchInsert('periods',
            ['title_ru', 'title_en'], [
                ['Ежедневно', 'Everyday'],
                ['Раз в месяц', 'Once a month'],
                ['Раз в год', 'Once a year'],
                ['Раз в квартал', 'Once a quarter'],
                ['Раз в неделю', 'Once a week'],
                ['По будням', 'On weekdays'],
                ['По выходным', 'On weekends'],
            ]);
        $this->addForeignKey('tasks_to_repeat_types','mission_tasks','repeat_type_id','periods','id','restrict','restrict');
        $this->addForeignKey('types_to_periods','mission_types','period_id','periods','id','restrict','restrict');
    }
}
