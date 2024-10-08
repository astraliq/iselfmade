<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/style.css',
        'css/animation.css',
        'css/fontello.css',
        'css/fontello-codes.css',
        'css/fontello-embedded.css',
        'css/fontello-ie7.css',
        'css/fontello-ie7-codes.css',
        'css/modal_image.css',
    ];
    public $js = [
//        'js/jquery-3.5.1.min.js',
        'js/jquery.maskedinput.min.js',
        'js/autosize.js',
        'js/main.js',
        'js/comments.js',
        'js/main_menu.js',
        'js/modal_img.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
