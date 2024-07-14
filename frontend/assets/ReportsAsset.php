<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class ReportsAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/modal_image.css',
    ];
    public $js = [
        'js/reports.js',
        'js/modal_img.js',
    ];

}