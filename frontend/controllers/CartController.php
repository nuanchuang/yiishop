<?php

namespace frontend\controllers;

use backend\models\Goods;
use frontend\models\Cart;

class CartController extends \yii\web\Controller
{
    public $layout = 'list';//模板文件
    public function actionIndex()
    {
        $goods = Goods::find()->all();
        return $this->render('index',['goods'=>$goods]);
    }
}