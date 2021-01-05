<?php

/* @var $this yii\web\View */

?>

<main class="main__style">
    <section class="f-screen__style">
        <div class="f-screen__left">
            <p class="f-screen__left-text">Текущая дата, день недели, неделя и день в году</p>
            <p class="f-screen__left-text">Дополнительные сервисы помогут дойти до конца</p>
        </div>
        <div class="f-screen__center">
            <p class="f-screen__center-text">
                Цели на год и задачи на текущий месяц всегда перед вами, как напоминание.<br>Так эффективнее планировать дела на день.
            </p>
            <img class="f-screen__img" src="img/screens/f-screen.png" width="1098" height="640" alt="Главный экран. Отчёт">
            <p class="f-screen__center-caption">
                Раздел &laquo;Отчёт&raquo;.<br>Это основной раздел, с которым вам придётся работать. <br>Тут вы отчитываетесь за сегодняшний день и планируете следующий.
            </p>
        </div>
        <div class="f-screen__right">
            <p class="f-screen__right-text">
                Аватарка пользователя и дополнительное меню с настройками
            </p>
            <p class="f-screen__right-text">
                Коэффециент выполнения дел за день. Влияет на условия работы с сервисом.
            </p>
        </div>
    </section>
    <section class="title section_container">Как это работает</section>
    <section class="curator">
        <div class="section_container">
            <h2 class="chapter__title">Персональный куратор</h2>
            <p class="curator__text">
                У вас будет <strong>персональный куратор</strong>. Он будет проверять каждый отчёт, который вы заполняете в системе. А в тарифах &laquo;Результат&raquo; и &laquo;Прорыв&raquo;, куратор ещё и <strong>звонит вам по телефону</strong>,
                чтобы узнать как много дел вы уже выполнили сегодня.
            </p>
            <div class="curator__sound">
                <audio id="audio" src=""></audio>
                <div class="curator__sound-oval audio-controls">
                    <button class="curator__sound-round play">►</button>
                    <button class="curator__sound-round pause">&#10074;&#10074;</button>
                    <div class="audio-track">
                        <div class="time"></div>
                    </div>
                    <p class="curator__sound-text track-name">Фрагмент разговора с куратором</p>
                    <div class="track-volume">
                        <input type="range" class="volume" name="volume" min="0" max="10" value="1">
                    </div>
                </div>
            </div>
            <p class="curator__text">
                Для некоторых дел, которые вы указали в отчёте, вашему куратору могут потребоваться «доказательства». Например, скрин подготовленного письма или составленное резюме для поиска новой работы.
            </p>
            <div class="curator__img">
                <img src="img/screens/curator-messages.png" width="555" height="370" alt="Фрагмент переписки с куратором">
                <p class="curator__caption">Фрагмент чата с куратором.</p>
            </div>
            <p class="curator__text">
                Ни нам, ни куратору не нужны конфиденциальные данные или «доказательства» на каждый выполненный пункт. </p>
            <p class="curator__text">Основная задача — не допустить отчёты–отписки и сделать так, чтобы каждый отчёт был осознанным и достоверным.
            </p>
        </div>
        <div class="container_full">
            <div class="section_container">
                <p class="curator__info">
                    Куратор верит в вас.<br>Не подведите его — сделайте уже то, что запланировали.
                </p>
            </div>
        </div>
    </section>
    <section class="tutor">
        <div class="section_container">
            <h2 class="chapter__title">Человек, перед которым стыдно облажаться</h2>
            <p class="tutor__text">
                <strong>Наставник</strong> &#151; человек, перед которым вам лично будет очень неудобно, если он узнает, что вы не выполнили то, что планировали и тем самым не достигли намеченных целей.
            </p>
            <p class="tutor__text">
                В детстве, чаще всего, для нас это была мама (&laquo;только бы мама не узнала&raquo;). Во взрослой жизни это человек, который добился больше. В чём&#150;то он наш ориентир, тот, на кого мы хотим быть похожи.
            </p>
            <p class="tutor__text">
                Укажите его почту и он будет получать сводный отчёт о ваших успехах. И представьте, как потом будете смотреть ему в глаза.
            </p>
            <div class="tutor__img">
                <img src="img/screens/tutor-mail.png" width="768" height="473" alt="Сводный отчёт наставнику">
                <p class="tutor__caption">Сводный отчёт, который получает наставник.</p>
            </div>
        </div>
    </section>
    <section class="section_container">
        <div class="chapter">
            <h2 class="chapter__title">Работы с ментором</h2>
            <p class="chapter__text">Если у вас есть ментор, то укажите его почту, чтобы и он получал сводный отчёт ваших успехов.</p>
            <p class="chapter__text">Если же ментора нет, то вы можете найти его в нашем списке менторов. Мы тчательно состовляем этот список, поэтому совершенно уверены в профессионализме каждого, кто там указан.</p>
        </div>
        <div class="chapter">
            <h2 class="chapter__title">Группа поддержки</h2>
            <p class="chapter__text">В достижении целей важно ощущать поддержку людей, которые верят в тебя.<br>Приглашайте в &laquo;НОСОРОГ&raquo; своих друзей и знакомых, и создавайте свою группу поддержки.</p>
            <p class="chapter__text">Если своей группы поддержки нет, то можно присоедениться к уже существующим. Группы, в которых есть свободные места, размещаны в соответствующем разделе.</p>
        </div>
        <div class="chapter">
            <h2 class="chapter__title">Коэффициент выполнения</h2>
            <p class="chapter__text">По результатам «рабочего дня» система рассчитывает ваш коэффециент выполнения.<br>Не допускайте, чтобы коэффециент был ниже 60%.</p>
            <p class="chapter__text">Если такое случится <strong>5 дней</strong> в текущем месяце, то система блокирует вашу учётную запись. Восстановление возможно только через техническую поддержку.</p>
        </div>
    </section>
    <section class="container_full container_full-240">
        <div class="section_container">
            Система &laquo;НОСОРОГ&raquo;&nbsp;&#151; не просто программа для списка дел.<br> Это целый набор сервисов, которые помогают вам делать то, что вы запланировали.
        </div>
    </section>
    <section class="other">
        <div class="section_container">
            <p class="title">Дополнительные сервисы</p>
            <h2 class="chapter__title">Доска эффективности</h2>
            <p class="chapter__text">
                На этой доске собраны статистические данные ваших успехов и достижений. Сколько дел было выполненно, сколько задач месяца вы завершили и каких целей уже добились.
            </p>
            <div class="tutor__img">
                <img src="img/screens/tutor-mail.png" width="768" height="473" alt="Сводный отчёт наставнику">
                <p class="tutor__caption">Доска эффективности пользователя</p>
            </div>
            <div class="chapter">
                <h2 class="chapter__title">Повторяющиеся дела</h2>
                <p class="chapter__text">Укажите, какие дела вы планируете делать постоянно, внесите их в специальный раздел и они будут появляться в плане нужного дня.</p>
            </div>
            <div class="chapter">
                <h2 class="chapter__title">Будущие дела</h2>
                <p class="chapter__text">Если вы уже сейчас знаете, что нужно будет сделать в конкретный день в будщем, то запишите это в этот раздел и система сама включит это дело в нужный день.</p>
            </div>
            <div class="chapter">
                <h2 class="chapter__title">мои обещания</h2>
                <p class="chapter__text">Записывайте что и кому обещали сделать.</p>
            </div>
            <div class="chapter">
                <h2 class="chapter__title">Возможные дела</h2>
                <p class="chapter__text">Всё, что вам кажется может быть придётся делать в будущем. Записывайте, чтобы не забыть.</p>
            </div>
            <div class="other__button">
                <input id="show_more" class="show_more" type="checkbox">
                <label for="show_more" class="other__btn btn__shadow hide_blocks_label">Посмотреть все сервисы</label>
<!--                СКРЫТЫЕ БЛОКИ-->
                <div class="chapter">
                    <h2 class="chapter__title">...........мои обещания............</h2>
                    <p class="chapter__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur atque autem consectetur consequuntur dolorem</p>
                </div>
                <div class="chapter">
                    <h2 class="chapter__title">.............Возможные дела............</h2>
                    <p class="chapter__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At beatae consequuntur distinctio eius et facere labore magni numquam tempore vero!.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="container_full container_full-280">
        <div class="section_container">
            Мы постепенно добавляем новые сервисы.<br> Есть идея нового сервиса?<br>
            <a class="plate-link" href="#">Напишите нам</a> любым удобным вам способом.<br> Готовы обсуждать.
        </div>
    </section>
    <section class="rates">
        <div class="section_container">
            <p class="title">Тарифы</p>
        </div>
        <div class="rates__items">
            <div class="rates__item rates-text">
                <p class="rates__text">
                    Название тарифа и его стоимость
                </p>
                <p class="rates__text">
                    <strong>Бесплатный период</strong>
                </p>
                <p class="rates__text">
                    Количество «<strong>рабочих дней</strong>», когда нужно писать отчёт (в неделю)
                </p>
                <p class="rates__text">
                    Количество дней, когда <strong>можно пропустить</strong> сдачу отчёта (в месяц)
                </p>
                <p class="rates__text">
                    <strong>Минимальный</strong> коэффициент выполнения дневных дел
                </p>
                <p class="rates__text">
                    Работа с целями, задачами и делами на день
                </p>
                <p class="rates__text">
                    Отчёт принимает куратор
                </p>
                <p class="rates__text">
                    Отправка сводного отчёта наставнику/ментору
                </p>
                <p class="rates__text">
                    Группа поддержки
                </p>
                <p class="rates__text">
                    Звонок от куратора (<strong>3 раза в неделю</strong>)
                </p>
                <p class="rates__text">
                    Звонок от куратора (<strong>каждый рабочий день</strong>)
                </p>
            </div>
            <div class="rates__item rates-standart">
                <p class="rates__name">Тариф «СТАНДАРТ»</p>
                <p class="rates__price">99 ₽/месяц</p>
                <p class="rates__free-pay">3 месяца</p>
                <p class="rates__work-day">5</p>
                <p class="rates__free-day">1</p>
                <p class="rates__ratio">75%</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__minus">–</p>
                <p class="rates__minus">–</p>
                <p class="rates__minus">–</p>
                <div class="rates__button">
                    <button class="rates__btn btn__shadow" id="btn_start_free">Попробовать бесплатно</button>
                </div>
            </div>
            <div class="rates__item rates-result">
                <p class="rates__name">Тариф «РЕЗУЛЬТАТ»</p>
                <p class="rates__price">249 ₽/месяц</p>
                <p class="rates__free-pay">&#151;</p>
                <p class="rates__work-day">6</p>
                <p class="rates__free-day">2</p>
                <p class="rates__ratio">70%</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__minus">–</p>
                <div class="rates__button">
                    <!-- <button class="rates__btn" id="btn_start_result" disabled>Начать</button> -->
                    <p class="rates__name">Доступен с 01.03.2021</p>
                </div>
            </div>
            <div class="rates__item rates-break">
                <p class="rates__name">Тариф «ПРОРЫВ»</p>
                <p class="rates__price">749 ₽/месяц</p>
                <p class="rates__free-pay">&#151;</p>
                <p class="rates__work-day">6</p>
                <p class="rates__free-day">3</p>
                <p class="rates__ratio">75%</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__plus">+</p>
                <p class="rates__minus">–</p>
                <p class="rates__plus">+</p>
                <div class="rates__button">
                    <!-- <button class="rates__btn" id="btn_start_break" disabled>Начать</button> -->
                    <p class="rates__name">Доступен с 01.03.2021</p>
                </div>
            </div>
        </div>
    </section>
    <div class="modal2 invisible" id="modal2">
        <div class="modal2_group">
            <div class="modal2__close" id="close2">×</div>
            <button class="modal2__btn_mark modal2__mark_login" id="loginbtn2">Войти</button>
            <button class="modal2__btn_mark modal2__mark_reg" id="regbtn2">Зарегистрироваться</button>
            <div class="modal2__style invisible" id="mwindow-login2">
                <p class="modal2__title">Вход в систему</p>
                <?php $form=\yii\bootstrap\ActiveForm::begin([
                    'validateOnBlur' => false,
                    'validateOnChange' => true,
                    'enableAjaxValidation' => true,
//                    'enableClientValidation' => true,
//                    'validationUrl' => '/auth/validate-sign-in',
                    'action' => '/auth/sign-in',
                    'options' => [
                        'id' => 'form-login2',
                        'class' => 'modal2__form'
                    ]
                ]); ?>
                <?=$form->field($this->params['signIn'],'email',['validateOnChange' => false])->textInput(['class' => 'modal2__input', 'id' => 'login2-user-email', 'type' => 'email', 'autocomplete' => 'username'])->error(false)?>
                <?=$form->field($this->params['signIn'],'password')->passwordInput(['class' => 'modal2__input', 'id' => 'login2-user-password', 'type' => 'password', 'autocomplete' => 'current-password'])?>
                <div class="modal2__sub">
                    <button type="submit" class="modal2__btn">Войти</button>
                    <!--                <a class="modal2__link" id="remind2">Напомнить пароль</a>-->
                </div>
                <?php \yii\bootstrap\ActiveForm::end();?>
            </div>

            <div class="modal2__style" id="mwindow-reg2">
                <p class="modal2__title">Регистрация</p>

                <?php $form=\yii\bootstrap\ActiveForm::begin([
                    'validateOnChange' => false,
                    'enableAjaxValidation' => true,
                    'action' => '/auth/sign-up',
                    'options' => [
                        'id' => 'form-reg2',
                        'class' => 'modal2__form-sign_up'
                    ]
                ]); ?>
                <?=$form->field($this->params['signUp'],'email',['validateOnChange' => true])->textInput(['class' => 'modal2__input', 'id' => 'reg2-user-email', 'type' => 'email', 'autocomplete' => 'username']);?>
                <?=$form->field($this->params['signUp'],'password')->passwordInput(['class' => 'modal2__input', 'id' => 'reg2-user-password', 'type' => 'password', 'autocomplete' => 'new-password'])?>
                <?=$form->field($this->params['signUp'],'repeat_password')->passwordInput(['class' => 'modal2__input', 'id' => 'reg2-user-repeat_password', 'type' => 'password', 'autocomplete' => 'new-password']);?>
                <p class="modal2__sign-text">Нажимая на кнопку, вы соглашаетесь с <a class="modal2__sign-text_link" href="#">нашими правилами</a>
                    и <a class="modal2__sign-text_link" href="#">политикой конфиденциальности</a></p>
                <div class="modal2__sub">
                    <button type="submit" class="modal2__btn modal2__btn-sign">Зарегистрироваться</button>
                </div>
                <?php \yii\bootstrap\ActiveForm::end();?>
            </div>
        </div>
    </div>
    <section class="rhino">
        <p class="rhino__text">
            Носорог&nbsp;&#151; спокойное и упрямое животное. <br>Своим рогом расчищает себе путь: ломает ветки, стоящие на его пути. При опасности может рогом нанести сокрушительный удар врагу.
        </p>
    </section>
</main>
