<?php

namespace app\controllers\actions\site;

use app\components\ReportCommentsComponent;
use app\models\ReportComments;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\web\HttpException;
use yii\web\Response;

class EventsUpdateAction extends Action {

    protected function beforeRun() {
//        \Yii::$app->response->format = 'sse';
        header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream");
        header("Connection: keep-alive");
        header("X-Accel-Buffering: no");
//        header("Access-Control-Allow-Origin: *");
        return true; // TODO: Change the autogenerated stub
    }

    public function run() {

        session_write_close();

        if (\Yii::$app->user->isGuest) {
            throw new HttpException(403, "Доступ запрещен!");
        }
        $reqHeaders = \Yii::$app->request->headers;
        if (!\Yii::$app->request->isGet && !\Yii::$app->request->isAjax && $reqHeaders->get("Connection") !== "keep-alive") {
            throw new HttpException(400, "Некорректный запрос");
        }

//        ignore_user_abort(true); // Stops PHP from checking for user disconnect

//        @ini_set('zlib.output_compression',0);
//        @ini_set('implicit_flush',1);
//        @ini_set('output_buffering', 'Off');
//        @ini_set('output_handler', '');
//        @ini_set('implicit_flush','On');

        $updateInterval = 2; // интервал обновления в секундах
        $limitEvents = 3600 / $updateInterval * 3; // лимит соединения, часов
        $limitCounter = 1;
        $compComments = \Yii::createObject(['class' => ReportCommentsComponent::class,'modelClass' => ReportComments::class]);
        $idCounter = 0;
        echo "retry:15000\n\n"; // указывает серверу через какое кол-во миллисекунд выполнять переподключение в случае разрыва соединения

        while ($limitCounter < $limitEvents) {

            $newComments = $compComments->getNewComments();
            $sendData = [];
            $sendData['count'] = $newComments ? count($newComments) : 0;
            $sendData['report_ids'] = [];
            if ($newComments) {
                foreach ($newComments as $comment) {
                    $sendData['report_ids'][] = $comment->report_id;
                }
                $sendData['report_ids'] = array_unique($sendData['report_ids']);
            }

            $sendData = json_encode($sendData);

            echo "event:notifCountData\n";
            echo "data: {$sendData}\n";
            echo "id: {$idCounter}\n\n";

//                echo ": keep connection\n\n";

            // Прерывание цикла, если клиент прервал соединение
            if (connection_aborted()) break;

            @ob_end_flush();
            @flush();

            $idCounter++;
            $limitCounter++;
            sleep($updateInterval);
        }

        echo "data:\n";
        echo "id:-1\n\n";
        @ob_end_flush();
        @flush();
        exit();
    }

    protected function afterRun() {
        parent::afterRun(); // TODO: Change the autogenerated stub
    }

}
