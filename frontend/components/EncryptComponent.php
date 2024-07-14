<?php


namespace frontend\components;


use common\base\BaseComponent;

class EncryptComponent extends BaseComponent {

    public function encryptData($data, $key1, $key2, $randomKey, $key3) {
        return utf8_encode(\Yii::$app->security->encryptByKey( $data, $this->genSecret($key1, $key2, $dateKey, $key3)));
    }

    public function expandData($data, $key1, $key2, $randomKey, $key3) {
        return \Yii::$app->security->decryptByKey(utf8_decode($data), $this->genSecret($key1, $key2, $dateKey, $key3));
    }

    private function genSecret($key1, $key2, $randomKey, $key3) {
        $strrev = strrev($randomKey);
        $secret = $key3 . substr($strrev, 0 ,4) . $key2 . substr($strrev, 5 ) . $key1;
        return md5($secret);
    }

    public function genFalseKey() {
        return \Yii::$app->security->generateRandomString();
    }

}