<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2017/4/9
 * Time: 14:30
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class ListAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/bottomnav.css',
        'style/footer.css',
        'style/list.css',
        'style/common.css',
        'style/goods.css',
        'style/cart.css',
        'style/fillin.css',
        'style/success.css',
    ];
    public $js = [
        'js/jquery-1.8.3.min.js',
        'js/header.js',
        'js/list.js',
        'js/goods.js',
        'js/cart.js',
        'js/cart2.js',
        'js/jqzoom-core.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}