<?php

namespace frontend\controllers;

use frontend\models\Goods;

class GoodsController extends \yii\web\Controller
{

    public $layout = 'list';
    public function actionIndex()
    {
        $model = new Goods();

        return $this->render('index',['model'=>$model]);
    }


}
