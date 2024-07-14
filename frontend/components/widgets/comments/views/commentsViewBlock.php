<?php

?>

<section class="comments" id="comments" data-report_id="<?=$report->id?>">
    <h2 class="comments__title">Комментарии</h2>
    <div class="comments__block">
        <?php
        if ($comments) {
            $comments = array_reverse($comments, true);
            foreach ($comments as $comment) {
                echo \frontend\components\widgets\comments\OneCommentWidget::widget([
                    'comment' => $comment,
                    'self' => $self,
                ]);
            }
        } else {
            echo '<p class="comments__no">Комментарии отсутствуют... </p>';
        }
        ?>
    </div>
        <?php
        if ($report->status < 3)
        echo \frontend\components\widgets\comments\CreateCommentWidget::widget([
                'self' => $self,
            ]
        );
        ?>
</section>