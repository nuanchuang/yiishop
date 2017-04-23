<?php

namespace frontend\controllers;

use backend\models\Goods;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Order;

class OrderController extends \yii\web\Controller
{
    public $layout = 'list';
//    public function actionIndex()
//    {
//        return $this->render('index');
//    }
    public function actionCart2(){
        $models = Goods::find()->all();
        $cart = Cart::find()->all();
        $addresses = Address::find()->all();
        return $this->render('index',['models'=>$models,'cart'=>$cart,'addresses'=>$addresses]);
    }


    public function actionCart3(){
        $models = Order::find()->all();

        return $this->render('cart3',['models'=>$models]);
    }
}
