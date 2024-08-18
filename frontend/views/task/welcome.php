<?php

$month = \Yii::$app->params['monthsImenit'][\Yii::$app->formatter->asDate(date('Y-m-d'), 'M')];

?>

<section class="welcome">
    <h1 class="welcome__title">Хорошо, что ты теперь с нами!</h1>
    <p class="welcome__chapter">С чего начать</p>
    <p class="welcome__text">
        Заполни свои <a target="_blank" class="welcome__link" href="goals">цели на год и задачи</a> на ближайший месяц. Они всегда будут доступны тебе в разделе «Отчёт». Их в любой момент можно там отредактировать.
    </p>
    <p class="welcome__text">
        Мы используем такие формулировки и определения. Цель&nbsp;&#151; что–то глобальное, &laquo;большое&raquo;. Как правило то, что планируешь достигнуть в течении года (не обязательно календарного). Чтобы её достичь, мы разбиваем цель на задачи. Примерный срок выполнения задачи&nbsp;&#151; месяц. Задачи же состоят из дел, которые мы выполняем каждый день.
    </p>
    <p class="welcome__text">Цель &#10144; Задача &#10144; Дело</p>
    <p class="welcome__text">После целей и задач заполни <a target="_blank" class="welcome__link" href="profile">свой профиль</a>. Твоё имя и фото нужны для наставника, ментора и работе в группе поддержки.</p>
    <p class="welcome__chapter">Антислив</p>
    <p class="welcome__text">
        Мы поняли, что основная сложность не в том, чтобы начать что–то делать, а в том, чтобы продолжать делать то, что уже начали каждый день.
    </p>
    <p class="welcome__text">
        Именно для этого мы придумали дополнительные сервисы и раздел &laquo;<a target="_blank" class="welcome__link" href="#">Антислив</a>&raquo;. Там полезные материалы, чтобы продолжать и продолжать делать то, что у тебя в планах.
    </p>
    <p class="welcome__text">
        У тебя будет персональный куратор. Его основная задача проверять твой отчёт каждый день, в течении 24–х часов. А в <a target="_blank" class="welcome__link" href="#">тарифах «Результат» и «Прорыв»</a>, куратор ещё и звонит тебе по телефону, чтобы узнать
        как много дел уже выполнено.
    </p>
    <p class="welcome__text">
        Наставник&nbsp;&#151; человек, перед которым тебе будет очень стыдно облажаться и не выполнить свои дела. Система так настроена, что ему на почту будет приходить отчёт о твоей эффективности. Но для этого, <a target="_blank" class="welcome__link" href="mentor">укажи почту наставника</a>                    в соответствующих настройках. И выполняй всё, что записано в твоём плане&nbsp;&#151; не расстраивай своего Наставника.
    </p>

    <p target="_blank" class="welcome__chapter">Чат поддержки и соцсети</p>
    <p class="welcome__text">
        Подписывайся на наши официальные аккаунты в соцсетях и получай интересную и полезную информацию там, где тебе удобнее всего.
    </p>
    <div class="welcome__soc">
        <div class="soc__items">
            <a class="soc__item" href="https://www.instagram.com/iselfmade.ru/" target="_blank">
                <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m305 256c0 27.0625-21.9375 49-49 49s-49-21.9375-49-49 21.9375-49 49-49 49 21.9375 49 49zm0 0"/><path d="m370.59375 169.304688c-2.355469-6.382813-6.113281-12.160157-10.996094-16.902344-4.742187-4.882813-10.515625-8.640625-16.902344-10.996094-5.179687-2.011719-12.960937-4.40625-27.292968-5.058594-15.503906-.707031-20.152344-.859375-59.402344-.859375-39.253906 0-43.902344.148438-59.402344.855469-14.332031.65625-22.117187 3.050781-27.292968 5.0625-6.386719 2.355469-12.164063 6.113281-16.902344 10.996094-4.882813 4.742187-8.640625 10.515625-11 16.902344-2.011719 5.179687-4.40625 12.964843-5.058594 27.296874-.707031 15.5-.859375 20.148438-.859375 59.402344 0 39.25.152344 43.898438.859375 59.402344.652344 14.332031 3.046875 22.113281 5.058594 27.292969 2.359375 6.386719 6.113281 12.160156 10.996094 16.902343 4.742187 4.882813 10.515624 8.640626 16.902343 10.996094 5.179688 2.015625 12.964844 4.410156 27.296875 5.0625 15.5.707032 20.144532.855469 59.398438.855469 39.257812 0 43.90625-.148437 59.402344-.855469 14.332031-.652344 22.117187-3.046875 27.296874-5.0625 12.820313-4.945312 22.953126-15.078125 27.898438-27.898437 2.011719-5.179688 4.40625-12.960938 5.0625-27.292969.707031-15.503906.855469-20.152344.855469-59.402344 0-39.253906-.148438-43.902344-.855469-59.402344-.652344-14.332031-3.046875-22.117187-5.0625-27.296874zm-114.59375 162.179687c-41.691406 0-75.488281-33.792969-75.488281-75.484375s33.796875-75.484375 75.488281-75.484375c41.6875 0 75.484375 33.792969 75.484375 75.484375s-33.796875 75.484375-75.484375 75.484375zm78.46875-136.3125c-9.742188 0-17.640625-7.898437-17.640625-17.640625s7.898437-17.640625 17.640625-17.640625 17.640625 7.898437 17.640625 17.640625c-.003906 9.742188-7.898437 17.640625-17.640625 17.640625zm0 0"/><path d="m256 0c-141.363281 0-256 114.636719-256 256s114.636719 256 256 256 256-114.636719 256-256-114.636719-256-256-256zm146.113281 316.605469c-.710937 15.648437-3.199219 26.332031-6.832031 35.683593-7.636719 19.746094-23.246094 35.355469-42.992188 42.992188-9.347656 3.632812-20.035156 6.117188-35.679687 6.832031-15.675781.714844-20.683594.886719-60.605469.886719-39.925781 0-44.929687-.171875-60.609375-.886719-15.644531-.714843-26.332031-3.199219-35.679687-6.832031-9.8125-3.691406-18.695313-9.476562-26.039063-16.957031-7.476562-7.339844-13.261719-16.226563-16.953125-26.035157-3.632812-9.347656-6.121094-20.035156-6.832031-35.679687-.722656-15.679687-.890625-20.6875-.890625-60.609375s.167969-44.929688.886719-60.605469c.710937-15.648437 3.195312-26.332031 6.828125-35.683593 3.691406-9.808594 9.480468-18.695313 16.960937-26.035157 7.339844-7.480469 16.226563-13.265625 26.035157-16.957031 9.351562-3.632812 20.035156-6.117188 35.683593-6.832031 15.675781-.714844 20.683594-.886719 60.605469-.886719s44.929688.171875 60.605469.890625c15.648437.710937 26.332031 3.195313 35.683593 6.824219 9.808594 3.691406 18.695313 9.480468 26.039063 16.960937 7.476563 7.34375 13.265625 16.226563 16.953125 26.035157 3.636719 9.351562 6.121094 20.035156 6.835938 35.683593.714843 15.675781.882812 20.683594.882812 60.605469s-.167969 44.929688-.886719 60.605469zm0 0"/></svg>
            </a>
            <a class="soc__item" href="https://www.twitter.com/iselfmaderu/" target="_blank">
                <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m256 0c-141.363281 0-256 114.636719-256 256s114.636719 256 256 256 256-114.636719 256-256-114.636719-256-256-256zm116.886719 199.601562c.113281 2.519532.167969 5.050782.167969 7.59375 0 77.644532-59.101563 167.179688-167.183594 167.183594h.003906-.003906c-33.183594 0-64.0625-9.726562-90.066406-26.394531 4.597656.542969 9.277343.8125 14.015624.8125 27.53125 0 52.867188-9.390625 72.980469-25.152344-25.722656-.476562-47.410156-17.464843-54.894531-40.8125 3.582031.6875 7.265625 1.0625 11.042969 1.0625 5.363281 0 10.558593-.722656 15.496093-2.070312-26.886718-5.382813-47.140624-29.144531-47.140624-57.597657 0-.265624 0-.503906.007812-.75 7.917969 4.402344 16.972656 7.050782 26.613281 7.347657-15.777343-10.527344-26.148437-28.523438-26.148437-48.910157 0-10.765624 2.910156-20.851562 7.957031-29.535156 28.976563 35.554688 72.28125 58.9375 121.117187 61.394532-1.007812-4.304688-1.527343-8.789063-1.527343-13.398438 0-32.4375 26.316406-58.753906 58.765625-58.753906 16.902344 0 32.167968 7.144531 42.890625 18.566406 13.386719-2.640625 25.957031-7.53125 37.3125-14.261719-4.394531 13.714844-13.707031 25.222657-25.839844 32.5 11.886719-1.421875 23.214844-4.574219 33.742187-9.253906-7.863281 11.785156-17.835937 22.136719-29.308593 30.429687zm0 0"/></svg>
            </a>
            <a class="soc__item" href="https://www.facebook.com/iselfmaderu/" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 167.657 167.657">
                    <path d="M83.829,0.349C37.532,0.349,0,37.881,0,84.178c0,41.523,30.222,75.911,69.848,82.57v-65.081H49.626
                                    v-23.42h20.222V60.978c0-20.037,12.238-30.956,30.115-30.956c8.562,0,15.92,0.638,18.056,0.919v20.944l-12.399,0.006
                                    c-9.72,0-11.594,4.618-11.594,11.397v14.947h23.193l-3.025,23.42H94.026v65.653c41.476-5.048,73.631-40.312,73.631-83.154
                                    C167.657,37.881,130.125,0.349,83.829,0.349z"/></svg>

            </a>
            <a class="soc__item" href="https://www.vk.com/iselfmaderu/" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 97.75 97.75">
                    <path d="M48.875,0C21.883,0,0,21.882,0,48.875S21.883,97.75,48.875,97.75S97.75,75.868,97.75,48.875S75.867,0,48.875,0z
                                         M73.667,54.161c2.278,2.225,4.688,4.319,6.733,6.774c0.906,1.086,1.76,2.209,2.41,3.472c0.928,1.801,0.09,3.776-1.522,3.883
                                        l-10.013-0.002c-2.586,0.214-4.644-0.829-6.379-2.597c-1.385-1.409-2.67-2.914-4.004-4.371c-0.545-0.598-1.119-1.161-1.803-1.604
                                        c-1.365-0.888-2.551-0.616-3.333,0.81c-0.797,1.451-0.979,3.059-1.055,4.674c-0.109,2.361-0.821,2.978-3.19,3.089
                                        c-5.062,0.237-9.865-0.531-14.329-3.083c-3.938-2.251-6.986-5.428-9.642-9.025c-5.172-7.012-9.133-14.708-12.692-22.625
                                        c-0.801-1.783-0.215-2.737,1.752-2.774c3.268-0.063,6.536-0.055,9.804-0.003c1.33,0.021,2.21,0.782,2.721,2.037
                                        c1.766,4.345,3.931,8.479,6.644,12.313c0.723,1.021,1.461,2.039,2.512,2.76c1.16,0.796,2.044,0.533,2.591-0.762
                                        c0.35-0.823,0.501-1.703,0.577-2.585c0.26-3.021,0.291-6.041-0.159-9.05c-0.28-1.883-1.339-3.099-3.216-3.455
                                        c-0.956-0.181-0.816-0.535-0.351-1.081c0.807-0.944,1.563-1.528,3.074-1.528l11.313-0.002c1.783,0.35,2.183,1.15,2.425,2.946
                                        l0.01,12.572c-0.021,0.695,0.349,2.755,1.597,3.21c1,0.33,1.66-0.472,2.258-1.105c2.713-2.879,4.646-6.277,6.377-9.794
                                        c0.764-1.551,1.423-3.156,2.063-4.764c0.476-1.189,1.216-1.774,2.558-1.754l10.894,0.013c0.321,0,0.647,0.003,0.965,0.058
                                        c1.836,0.314,2.339,1.104,1.771,2.895c-0.894,2.814-2.631,5.158-4.329,7.508c-1.82,2.516-3.761,4.944-5.563,7.471
                                        C71.48,50.992,71.611,52.155,73.667,54.161z"/></svg>
            </a>

            <a class="soc__item" href="https://www.t.me/iselfmaderu/" target="_blank">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12 24c6.629 0 12-5.371 12-12s-5.371-12-12-12-12 5.371-12 12 5.371 12 12 12zm-6.509-12.26 11.57-4.461c.537-.194 1.006.131.832.943l.001-.001-1.97 9.281c-.146.658-.537.818-1.084.508l-3-2.211-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953z"/></svg>
            </a>
        </div>
    </div>
    <p class="welcome__text">Общий
        <a class="welcome__link" href="https://t.me/joinchat/WAi-c9XitRYBK6k3" target="_blank">чат поддержки в телеграм</a> для всех участников.<br> Присоединяйся, задавай вопросы, поддерживай других и делись своими успехами.
    </p>
<!--    <p class="welcome__chapter">Напоследок</p>-->
<!--    <p class="welcome__text">-->
<!--        Всю необходимую информацию о работе сервиса ты всегда сможешь прочитать в разделе &laquo;<a class="welcome__link" href="help">Помощь</a>&raquo;. А если там нет ответа на твой вопрос, то смело пиши нам <a class="welcome__link" href="#">любым из этих способов</a>.-->
<!--    </p>-->
    <p class="welcome__chapter">Мне всё понятно</p>
    <p class="welcome__text">
        Отлично.<br>Тогда давай начинать.
    </p>
    <p class="welcome__text">
        Заполняй свои <a target="_blank" class="welcome__link" href="goals">цели на год и задачи</a> на ближайший месяц.
    </p>
</section>
