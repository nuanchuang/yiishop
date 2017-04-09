<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;


class GoodsCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $model = new GoodsCategory();
        $models = GoodsCategory::find()->orderBy('tree,lft')->all();
        return $this->render('index',['models'=>$models]);
    }

    public function actionAdd(){
        $model = new GoodsCategory();
        //读取并验证数据
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->parent_id == 0){
                $model->makeRoot();//创建一级分类
//                var_dump($model);
//                exit;
//                $model->save();
            }else{
                //创建非一级分类
                $model->prependTo(GoodsCategory::findOne(['id'=>$model->parent_id]));
            }
            \Yii::$app->session->setFlash('success','添加成功');
//            return $this->refresh();//刷新本页
            return $this->redirect('index');
        }
        $models = GoodsCategory::find()->asArray()->all();
        $models[] = ['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $models = Json::encode($models);
        return $this->render('add',['model'=>$model,'models'=>$models]);
    }


    //编辑
    public function actionEdit($id){
        $model = GoodsCategory::findOne(['id'=>$id]);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            try{
                if($model->parent_id == 0){
                    $model->makeRoot();//创建一级分类
//                var_dump($model);
//                exit;
//                $model->save();
                }else{
                    //创建非一级分类
                    $model->prependTo(GoodsCategory::findOne(['id'=>$model->parent_id]));
                }
                \Yii::$app->session->setFlash('success','编辑成功');
//                   return $this->refresh();//刷新本页
                return $this->redirect('index');
            }catch(Exception $e){
                \Yii::$app->session->setFlash('danger',$e->getMessage());
//                $model->addError('parent_id',$e->getMessage());
            }
        }
        $models = GoodsCategory::find()->asArray()->all();
        $models[] = ['id'=>0,'parent_di'=>0,'name'=>'顶级分类'];
        $models = Json::encode($models);
        return $this->render('add',['model'=>$model,'models'=>$models]);
    }


    public function actionDel($id){
        GoodsCategory::deleteAll(['id'=>$id]);
        return $this->redirect('index');
//        return $this->refresh();//刷新本页
    }



    //测试插件
    public function actionTest(){

        $models = GoodsCategory::find()->all();
//        $this->layout = false;
        return $this->renderPartial('test',['models'=>$models]);
    }
}
