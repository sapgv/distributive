<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

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
        'css/site.css',
        'css/panel.css',
        'menu/css/menu.css',
        'css/bootstrap-slider.css', //слайдер для цены
        'css/nav-shop.css', /*табы в вьюхе продукта*/
    ];
    public $js = [
        'js/bootstrap-slider.js', //слайдер для цены
        'menu/js/jquery.menu-aim.js',
        'menu/js/menu.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
