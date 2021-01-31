<?php


namespace app\widgets\comments;


use yii\base\Widget;

class CommentsWidget extends Widget {
    public $comments;
    public $self;
    public $report;

    public function run() {
        return $this->render('commentsViewBlock', [
            'comments' => $this->comments,
            'self' => $this->self,
            'report' => $this->report,
        ]);
    }
}