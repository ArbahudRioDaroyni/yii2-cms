<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
		'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap',
        'css/fontawesome.min.css',
        'css/style.css',
		'css/media.css',
    ];
    public $js = [
		'http://code.jquery.com/jquery-1.11.0.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js',
		'js/bootstrap.min.js',
		'https://kit.fontawesome.com/3fabd737b7.js',
		'//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
		'https://unpkg.com/scrollreveal',
        'js/back-top.js'
    ];
	
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
