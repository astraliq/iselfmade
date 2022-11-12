<?php

namespace app\components;

use yii\web\ResponseFormatterInterface;

class SSEFormatter implements ResponseFormatterInterface {

    public function format($response) {
        $resHeaders = $response->getHeaders();
        $resHeaders->removeAll();
        $resHeaders->add('Content-Type', 'text/event-stream');
        $resHeaders->add('Connection', 'keep-alive');
        $resHeaders->add('Cache-Control', 'no-cache');
        $resHeaders->add('X-Accel-Buffering', 'no');
        $resHeaders->add('Access-Control-Allow-Origin', '*');
        $resHeaders->add('AA', '++');
//        $response->content = '/n/n';
    }

}