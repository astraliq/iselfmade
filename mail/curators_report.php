<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<style>
    .logo {
        text-decoration: none;
        font-weight: 600;
    }
    .blue_logo {
        color: #4C91F8;
    }
    .black_logo {
        color: #000;
    }
    .logo:hover .blue_logo {
        color: #000;
    }
    .logo:hover .black_logo {
        color: #4C91F8;
    }
    .text__strike {
        text-decoration: line-through;
        text-decoration-color: #b1b1b1;
        color: #b1b1b1;
    }
    .grade {
        widows: 20px;
        height: 20px;
        background-color: #4C91F8;
        border-radius: 10px;
        color: white;
        margin: 0 5px;
    }
</style>
<h3>Отчет пользователя: <?=$surname?> <?=$name?></h3>
<br>
<br>
<?php
if ($reports) {
    foreach ($reports as $report) {
        echo '<p>Отчет за ' . $report['date'] . '</p>';

        if ($report['tasks']) {
            echo '<ol class="text__list_items">';
            foreach ($report['tasks'] as $task) {
                echo \app\widgets\tasks\OneTaskMailWidget::widget(
                    [
                        'task' => $task,
                    ]
                );
            }
            echo '</ol>';
        } else {
            echo '<span>Задачи отсутствуют</span>';
        }

    }
}

?>
<br>
<br>
<p>Поставьте пользователю оценку за выполнение задач:</p>
<a href="/" class="grade">1</a>
<a href="/" class="grade">2</a>
<a href="/" class="grade">3</a>
<a href="/" class="grade">4</a>
<a href="/" class="grade">5</a>
<br>
<br>
<p>Это письмо отправлено роботом, отвечать на него не нужно.</p>
<hr>
<p>С наилучшими пожеланиями, <br>Команда <a href="https://test.iselfmade.ru/" class="logo"><span class="black_logo">i</span><span class="blue_logo">self</span><span class="black_logo">made</span></a></p>

