<?php


namespace app\widgets\comments;


use yii\base\Widget;

class OneCommentWidget extends Widget {
    public $comment;
    public $self;

    public function run() {

        return $this->render('oneCommentBlock', [
            'comment' => $this->comment,
            'self' => $this->self,
        ]);
    }

}