<?php


namespace app\widgets\comments;


use yii\base\Widget;

class CreateCommentWidget extends Widget {
    public $self;

    public function run() {

        return $this->render('createCommentBlock', [
            'self' => $this->self,
        ]);
    }
}