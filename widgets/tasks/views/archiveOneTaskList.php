<?php

switch ($report->status) {
    case 1:
        $status = 'Ожидает проверки';
        break;
    case 2:
        $status = 'Просмотрен';
        break;
    case 3:
        $status = 'Не принят';
        break;
    case 4:
        $status = 'Принят';
        break;
}


?>


<div class="archive__data">
    <div class="archive__numb archive__numb-data"><?=$number?></div>
    <div class="archive__date archive__date-data">
        <a class="" href=""><?=$report->date?></a>
    </div>
    <div class="archive__status archive__status-data"><?=$status?></div>
    <div class="archive__done archive__done-data"><?=$finishedTasksCount?> из <?=$tasksCount?></div>
</div>
