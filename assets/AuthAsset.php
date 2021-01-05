<?php


namespace app\assets;


use yii\web\AssetBundle;

class AuthAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/mainpage.css',
    ];
    public $js = [
        'js/mainpage.js',
        'js/audio.js',
    ];

}