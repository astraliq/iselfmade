<?php


namespace app\assets;


use yii\web\AssetBundle;

class ErrorsAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/error.css',
    ];
    public $js = [
//        'js/modal_img.js',
    ];

}