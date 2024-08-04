<?php
\frontend\assets\StatisticsAsset::register($this);
?>
<div class="statistics">
    <div class="statistics__data">
        <h4 class="title">Показатели</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>Показатель</td>
                    <td>Значение</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Общее число зарегистрированных пользователей</td>
                    <td><?=$totalCountUsers?></td>
                </tr>
                <tr>
                    <td>Зарегистрировалось за последние сутки</td>
                    <td><?=$lastDayCountUsers?></td>
                </tr>
                <tr>
                    <td>Количетсво НЕ проверенных отчетов</td>
                    <td><?=$reportsCount?></td>
                </tr>
                <tr>
                    <td>Дата отправки последнего отчета</td>
                    <td><?=date('d.m.Y H:i:s', strtotime($lastReportDate))?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="statistics__users_list">
        <h4 class="title">Список пользователей</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>№ п/п</td>
                    <td>ФИО</td>
                    <td>Телефон</td>
                    <td>E-mail</td>
                    <td>Дата регистрации</td>
                    <td>Подтверждение e-mail</td>
                </tr>
            </thead>
            <tbody>
            <?= \frontend\components\widgets\user\UsersListWidget::widget([
                'users' => $allUsersList,
            ]); ?>
            </tbody>

        </table>
    </div>
</div>
