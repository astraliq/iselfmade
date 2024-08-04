<?php


namespace frontend\controllers\actions\report;


use frontend\components\ReportCommentsComponent;
use frontend\components\ReportsComponent;
use frontend\components\UserComponent;
use frontend\models\ReportComments;
use common\models\User;
use frontend\models\UsersReports;
use frontend\widgets\comments\OneCommentWidget;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

class AddCommentAction extends Action {
    public function run() {

        if (\Yii::$app->user->isGuest || !\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);
        $comment = $compComments->getModel();
        $compReports = \Yii::createObject(['class' => ReportsComponent::class,'modelClass' => UsersReports::class]);
        $report = $compReports->getModel();

        if (\Yii::$app->request->isPost) {
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
//                return ActiveForm::validate($user);
            }

            $comment->load(\Yii::$app->request->post());
            $report = $report->findOne(['id' => $comment->report_id]);

            if (!\Yii::$app->rbac->canAddReportComment($report)) {
                throw new HttpException(403, 'Нет доступа' );
            }

            if ($compComments->addReportComment($comment)) {
                $comment->date_create = gmdate('Y-m-d H:i:s');
                $comment->realDateCreate = $comment->date_create;
                if (\Yii::$app->request->isAjax) {
                    return ['result' => true,
                        'comment' => OneCommentWidget::widget([
                            'comment' => $comment,
                            'self' => \Yii::$app->user->getIdentity(),
                        ]),
                        'comment_id' => $comment->id,
                    ];
                }
            } else {
                return ['result' => false];
            }
        }

        return ['result' => false];
    }

}