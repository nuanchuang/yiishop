<?php

namespace frontend\controllers;

use backend\models\GoodsCategory;
use frontend\models\Goods;
use frontend\models\Index;

class IndexController extends \yii\web\Controller
{
    public $layout = 'index';//定义模板文件
    public function actionIndex()
    {
        $model = new Goods();
//        $models->find()->all();
        return $this->render('index',['model'=>$model]);
    }

    public function actionLogin(){
        return $this->redirect(['/member/login']);
    }

    public function actionRegister(){
        return $this->redirect(['/member/register']);
    }

    public function actionList(){
        return $this->redirect(['list']);
    }

}
