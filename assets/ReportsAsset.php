<?php


namespace app\assets;


use yii\web\AssetBundle;

class ReportsAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/mainpage.css',
    ];
    public $js = [
        'js/reports.js',
    ];

}