<?php

namespace app\assets;

use yii\web\AssetBundle;

class RanddAsset extends AssetBundle
{
	public $sourcePath = '@vendor/randd/carolus/assets';
    public $css = [
        'css/style.css',
        'css/responsive.css',
        'css/bootstrap.min.css',
        '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap',

    ];
    public $js = [
        'http://code.jquery.com/jquery-1.11.0.min.js',
        'js/bootstrap.min.js',
        'https://kit.fontawesome.com/3fabd737b7.js',
        '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        'https://unpkg.com/scrollreveal'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
