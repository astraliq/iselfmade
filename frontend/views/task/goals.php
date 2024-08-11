<?php
$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];

?>



<section class="welcome">
    <h1 class="welcome__title">Цели и задачи</h1>
    <p class="welcome__chapter"></p>
    <p class="welcome__text">
        Мы используем такие формулировки и определения.<br>Цель&nbsp;&#151; что–то глобальное, &laquo;большое&raquo;. Как правило то, что планируешь достигнуть в течении года (не обязательно календарного). Чтобы её достичь, мы разбиваем цель
        на задачи. Примерный срок выполнения задачи&nbsp;&#151; месяц. Задачи же состоят из дел, которые мы выполняем каждый день.
    </p>
    <p class="welcome__text">Цель &#10144; Задача &#10144; Дело</p>
    <p class="welcome__text">В этом разделе ты прописываешь только цели и задачи. Ежедневные дела ты будешь планировать в разделе &laquo;<a class="welcome__link" href="report">Отчёт</a>&raquo;.</p>
    <p class="welcome__chapter">Знаю чего хочу</p>
    <p class="welcome__text">
        Если ты уже знаешь свои цели и задачи, то можешь сразу записывать их тут.
    </p>
    <div class="goals">
        <div class="tasks-form ">
            <div class="tasks-all">
                <?= \frontend\components\widgets\tasks\TasksViewWidget::widget([
                    'title' => 'Цели на год',
                    'tasks' => $goals,
                    'del' => false,
                    'type_id' => 3,
                    'model' => $model,
                    'nextPeriod' => 0,
                    'renewLast' => $renewGoals ?? null,
                    'block_id' => 4,
                    'disabled' => false,
                ]); ?>
                <?= \frontend\components\widgets\tasks\TasksViewWidget::widget([
                    'title' => 'Задачи на '. $month ,
                    'tasks' => $aims,
                    'del' => false,
                    'type_id' => 2,
                    'model' => $model,
                    'nextPeriod' => 0,
                    'renewLast' => $renewAims ?? null,
                    'block_id' => 3,
                    'disabled' => false,
                ]); ?>
            </div>
        </div>
    </div>
    <p class="welcome__chapter">Рекомендации по постановке целей и задач</p>
    <p class="welcome__text">
        Самое главное, что нужно учитывать в постановке целей&nbsp;&#151; цели должны <strong>быть личными</strong>, идти изнутри. Вне зависимости от того, что другие думают по этому поводу. Пусть кому–то цель может показаться &laquo;мелкой&raquo;,
        незначительной&nbsp;&#151; не важно. Если это важно для тебя и именно <strong>ТЫ этого хочешь</strong>, то смело <strong>ставь эту цель</strong>.
    </p>
    <p class="welcome__text">
        Самая известная схема постановки целей считается <a class="welcome__link" href="https://ru.wikipedia.org/wiki/SMART" target="_blank">SMART</a>.
    </p>
    <p class="welcome__text">S&nbsp;&#151; specific (конкретная).</p>
    <p class="welcome__text">M&nbsp;&#151; measurable (измеримая).</p>
    <p class="welcome__text">A&nbsp;&#151; attainable (достижимая).</p>
    <p class="welcome__text">R&nbsp;&#151; realistic (реалистичная).</p>
    <p class="welcome__text">S&nbsp;&#151; time–bound (ограниченная во времени).</p>
    <p class="welcome__text">
        Именно её чаще всего цитируют и используют для постановки целей.
    </p>
    <p class="welcome__chapter">Что почитать про постановку целей</p>
    <p class="welcome__text">
        Вот несколько ссылок, где говориться про SMART и вообще про эффективную постановку целей.
    </p>
    <p class="welcome__text">
        <a class="welcome__link" href="https://lifehacker.ru/goals/" target="_blank">Статья в Лайфхакере</a> &laquo;Как правильно поставить цель и достичь её: инструкция с примерами&raquo;.
    </p>
    <p class="welcome__text">
        В блоге издательства &laquo;Манн, Иванов и Фербер&raquo; размещена статья &laquo;<a class="welcome__link" href="https://blog.mann-ivanov-ferber.ru/2020/01/09/kak-pravilno-stavit-celi/" target="_blank">Как правильно ставить цели?</a>&raquo;
    </p>
    <p class="welcome__text">
        В Reminder интересный материал &laquo;<a class="welcome__link" href="https://reminder.media/post/surprising-science-of-goal-setting" target="_blank">Когда цели вредят и как формулировать их правильно.</a>&raquo;
    </p>
</section>
