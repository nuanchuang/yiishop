<?php

namespace backend\controllers;

use backend\models\Menu;
use yii\helpers\Json;

class MenuController extends \yii\web\Controller
{
    //首页展示
    public function actionIndex()
    {
//        $models = new Menu();
//        $models->find()->all();
        $models = Menu::find()->all();//查询数据
//        var_dump($models);
//        exit;
        return $this->render('index',['models'=>$models]);//显示
    }

//添加
    public function actionAdd(){
        $model = new Menu();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
//            $authManager = \Yii::$app->authManager;
//            $authManager->($model);
            $model->save();
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['index']);
        }
//        $models = Menu::find()->asArray()->all();
//        $models[] = ['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
//        $models = Json::encode($models);
//        ['models'=>$models]
        return $this->render('add',['model'=>$model]);
    }

//修改
    public function actionEdit($id){
//        $model = new Menu();
        $model = Menu::findOne(['id'=>$id]);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
//            $authManager = \Yii::$app->authManager;
//            $authManager->($model);
            $model->save();
            \Yii::$app->session->setFlash('success','编辑成功');
            return $this->redirect(['index']);
        }
//        $models = Menu::find()->asArray()->all();
//        $models[] = ['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
//        $models = Json::encode($models);
//        ['models'=>$models]
        return $this->render('add',['model'=>$model]);
    }

//删除
    public function actionDel($id){
        Menu::deleteAll(['id'=>$id]);
        return $this->redirect(['index']);
    }

}
