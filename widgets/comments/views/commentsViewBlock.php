<?php

?>

<section class="comments" id="comments" data-report_id="<?=$report->id?>">
    <h2 class="comments__title">Комментарии</h2>
    <div class="comments__block">
        <?php
        if ($comments) {
            foreach ($comments as $comment) {
                echo \app\widgets\comments\OneCommentWidget::widget([
                    'comment' => $comment,
                    'self' => $self,
                    'today' => $today,
                ]);
            }
        } else {
            echo '<p class="comments__no">Комментарии отсутствуют... </p>';
        }
        ?>
    </div>
        <?php
        echo \app\widgets\comments\CreateCommentWidget::widget([
                'self' => $self,
            ]
        );

        ?>
</section>