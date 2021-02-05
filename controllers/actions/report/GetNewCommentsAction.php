<?php


namespace app\controllers\actions\report;


use app\components\ReportCommentsComponent;
use app\components\ReportsComponent;
use app\models\ReportComments;
use app\models\UsersReports;
use app\widgets\comments\OneCommentWidget;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class GetNewCommentsAction extends Action {
    public function run($lastCommentId, $reportId) {

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);
        $comment = $compComments->getModel();
        $compReports = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $report = $compReports->getModel();

        if (\Yii::$app->request->isGet) {
            \Yii::$app->response->format = Response::FORMAT_JSON;

            $report = $report->findOne(['id' => $reportId]);
            if (!\Yii::$app->rbac->canAddReportComment($report)) {
                throw new HttpException(403, 'Нет доступа' );
            }

            $newComments = $compComments->getNewComments($reportId);
            $newCommentsHTML = [];
            $newCommentsIDs = [];
            $compComments->updateViews($newComments);
            if ($newComments) {
                foreach ($newComments as $newComment) {
                    array_push($newCommentsHTML, OneCommentWidget::widget([
                        'comment' => $newComment,
                        'self' => \Yii::$app->user->getIdentity(),
                    ]));
                    array_push($newCommentsIDs, $newComment->id);
                }
                return ['result' => true,
                    'new_comments' => $newCommentsHTML,
                    'new_comments_ids' => $newCommentsIDs,
                ];
            } else {
                return ['result' => false];
            }
        }

        return ['result' => false];
    }

}