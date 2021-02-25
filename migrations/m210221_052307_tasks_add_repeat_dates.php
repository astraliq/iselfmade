<?php

use yii\db\Migration;

/**
 * Class m210221_052307_tasks_add_repeat_dates
 */
class m210221_052307_tasks_add_repeat_dates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('mission_tasks', 'repeat_start', $this->date()->defaultValue(null)->comment('дата начала повтора'));
        $this->addColumn('mission_tasks', 'repeat_end', $this->date()->defaultValue(null)->comment('дата конца повтора'));
        $this->addColumn('mission_tasks', 'repeat_created', $this->tinyInteger()->defaultValue(null)->comment('создана в разделе повторов'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('mission_tasks','repeat_end');
        $this->dropColumn('mission_tasks','repeat_start');
        $this->dropColumn('mission_tasks','repeat_created');
    }
}
