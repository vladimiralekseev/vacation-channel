<?php

namespace frontend\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/splide.min.css',
        'css/main.css?v=1',
        'fonts/vacation-channel/styles.css',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap',
    ];
    public $js = [
//        'https://www.youtube.com/player_api',
        'js/splide.min.js',
        'js/main.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        JqueryAsset::class,
    ];
}
