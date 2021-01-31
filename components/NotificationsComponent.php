<?php


namespace app\components;


use app\models\ReportComments;
use yii\base\Component;

class NotificationsComponent extends Component {
    public function getAllNotifications() {
        $userId = \Yii::$app->user->getId();

        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);
        $newComments = $compComments->getNewComments();
        return $newComments;
    }
}