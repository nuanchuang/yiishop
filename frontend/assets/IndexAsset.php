<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2017/4/9
 * Time: 14:30
 */

namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/bottomnav.css',
        'style/index.css',
        'style/footer.css',
    ];
    public $js = [
        'js/jquery-1.8.3.min.js',
        'js/header.js',
        'js/index.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//          'JqueryAsset::className()',
//        'yii\web\JqueryAsset',
        'yii\web\JqueryAsset',
    ];
}