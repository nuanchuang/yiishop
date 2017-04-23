<?php

namespace frontend\controllers;

use frontend\assets\LoginAsset;
use frontend\models\Address;

class AddressController extends \yii\web\Controller
{

    public $layout = 'address';//指定模板文件


    public function actionIndex()
    {
        return $this->redirect('/index/index');
    }


      public function actionAdd(){
          $model = new Address();
          if($model->load(\Yii::$app->request->post()) && $model->validate()){
              $model->address = $model->province.$model->city.$model->area.$model->address;
              $model->save();
              return $this->redirect(['index']);
          }
          return $this->render('add',['model'=>$model]);
      }


}
