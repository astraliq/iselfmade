<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "archive_tasks".
 *
 * @property int $id
 * @property int $user_id
 * @property int $private_id Приватность
 * @property int $type_id 1-Дело/2-Задача/3-Цель
 * @property int|null $cat_id Категория
 * @property int|null $aim_id Принадлежность к задаче
 * @property int|null $goal_id Принадлежность к целе
 * @property string $task ЗАДАЧА
 * @property string|null $main_img
 * @property string|null $buddy_ids Бадди - пользователи взявшие ответственность вместе с исполнителем
 * @property int|null $group_id ID группы поддержки
 * @property string|null $curators_ids Список id кураторов
 * @property string|null $curators_emails Список почт кураторов
 * @property string|null $hashtags Список хештегов через запятую
 * @property string|null $date_create
 * @property string|null $date_finish Дата завершения (факт)
 * @property string|null $date_calculate Целевая дата завершения
 * @property int|null $finished 0-в работе,1-завершено
 * @property int|null $deleted 0-не удалено,1-удалено
 * @property int|null $repeat_type_id null-без повтора,1-ежедневно,2-раз в месяц,3-раз в год
 */
class ArchiveTasksBase extends Tasks {
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archive_tasks';
    }

}
