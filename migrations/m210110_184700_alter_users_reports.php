<?php

use yii\db\Migration;

/**
 * Class m210110_184700_alter_users_reports
 */
class m210110_184700_alter_users_reports extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->renameTable('users_grades','users_reports');
        $this->addColumn('users_reports', 'files', $this->string(255)->comment('список файлов через /'));
        $this->addColumn('users_reports', 'self_grade', $this->tinyInteger()->comment('личная оценка дня'));
        $this->addColumn('users_reports', 'status', $this->tinyInteger()->comment('1-ожидает,2-просмотрен,3-под вопросом,4-проверен')->defaultValue(1));
        $this->addColumn('users_reports', 'curator_grade', $this->tinyInteger()->comment('оценка куратора'));
        $this->addColumn('users_reports', 'views', $this->tinyInteger()->comment('количество просмотров отчета')->defaultValue(0));
        $this->renameColumn('users_reports', 'grade', 'mentor_grade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->renameColumn('users_reports', 'mentor_grade', 'grade');
        $this->dropColumn('users_reports','views');
        $this->dropColumn('users_reports','curator_grade');
        $this->dropColumn('users_reports','status');
        $this->dropColumn('users_reports','self_grade');
        $this->dropColumn('users_reports','files');
        $this->renameTable('users_reports','users_grades');
    }

}
