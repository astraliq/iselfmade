<?php



/* @var $this \yii\web\View */
/* @var $users  */


?>

<?php
if ($users) {
    foreach ($users as $key => $user) {
        if ($user->confirm_email == 1) {
            $confEmail = 'E-mail подтвержден';
            $confEmailClass = 'success';
        } else {
            $confEmail = 'E-mail не подтвержден';
            $confEmailClass = 'failure';
        }
        echo '<tr>';
        echo '<td>' . ($key + 1) . '</td>';
        echo "<td>$user->name $user->surname</td>";
        echo "<td>$user->phone_number</td>";
        echo "<td>$user->email</td>";
        echo '<td>' . \Yii::$app->formatter->asDateTime($user->date_create, 'php:d F Y, H:i:s') . '</td>';
        echo '<td class="' . $confEmailClass . '">' . $confEmail . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td>Список пуст</td>';
    echo '</tr>';
}
?>
