<?php

namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\data\Pagination;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //实例化对象
        $models = ArticleCategory::find();
        //调用分页方法
        $pages = new Pagination([
            'totalCount' => $models->count(),
            'pageSize' => 3
        ]);
        //查询所有数据并分页
        $models = $models->limit($pages->limit)->offset($pages->offset)->all();
        //跳转至首页
        return $this->render('index',['models'=>$models,'pages'=>$pages]);
//        return $this->render('index');
    }


    //添加数据页面
    public function actionAdd(){
        //实例化对象
        $model = new ArticleCategory();
        //查询方法
        $request = \Yii::$app->request;
        //判定传输方式
        if($request->isPost){
            //接收post数据
            $model->load($request->post());
            //验证数据，并保存之后跳转
            if($model->validate()){
                $model->save();
                return $this->redirect(['article-category/index']);
            }
        }
        //非post方法跳转至添加页面
        return $this->render('add',['model'=>$model]);
    }

    //编辑数据
    public function actionEdit($id){
        //通过id查询对应数据并显示
        $model = ArticleCategory::findOne(['id'=>$id]);
        //查询方法
        $request = \Yii::$app->request;
        //判定传输方式
        if($request->isPost){
            //接收post数据
            $model->load($request->post());
            //验证数据，并保存之后跳转
            if($model->validate()){
                $model->save();
                return $this->redirect(['article-category/index']);
            }
        }
        //非post方法跳转至添加页面
        return $this->render('add',['model'=>$model]);
    }


    //删除数据
    public function actionDel($id){
        //根据传入ID删除对应的数据
        ArticleCategory::deleteAll(['id'=>$id]);
        //删除后跳转至首页
        return $this->redirect(['article-category/index']);
    }
}
