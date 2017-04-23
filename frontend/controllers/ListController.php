<?php
namespace frontend\controllers;

use frontend\models\ListForm;
use yii\web\Controller;

class ListController extends Controller{
    public $layout = 'list';//获取模板文件

    public function actionIndex(){
        $model = new ListForm();

        return $this->render('index',['model'=>$model]);
    }

    public function actionList(){
        return $this->redirect(['list']);
    }
}