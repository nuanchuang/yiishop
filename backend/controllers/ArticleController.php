<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\Articlecategory;
use backend\models\ArticleDetail;
use yii\data\Pagination;

class ArticleController extends \yii\web\Controller
{
    //首页
    public function actionIndex()
    {
        $models = Article::find();
        $pages = new Pagination([
            'totalCount' => $models->count(),
            'pageSize' => 3
        ]);
        $models = $models->limit($pages->limit)->offset($pages->offset)->all();

        return $this->render('index',['models'=>$models,'pages'=>$pages]);
    }

    public function actionAdd(){
        $article = new Article();
        $article_detail = new ArticleDetail();


        if($article->load(\Yii::$app->request->post())
            && $article_detail->load(\Yii::$app->request->post())
            && $article->validate()
            && $article_detail->validate()){

                $article->inputtime = time();
                $article->save();
                $article_detail->article_id = $article->id;
//                $article_id = $article_detail->id;
//                $article->id = $article_detail->id;
                $article_detail->save();
                return $this->redirect(['article/index']);
        }
        return $this->render('add',['article'=>$article,'article_detail'=>$article_detail]);
    }


    public function actionEdit($id){
        $article = Article::findOne(['id'=>$id]);
        $article_detail = ArticleDetail::findOne(['id'=>$id]);

        if($article->load(\Yii::$app->request->post())
            && $article_detail->load(\Yii::$app->request->post())
            && $article->validate()
            && $article_detail->validate()){

            $article->inputtime = time();
            $article->save();
            $article_detail->article_id = $article->id;
//                $article_id = $article_detail->id;
//                $article->id = $article_detail->id;
            $article_detail->save();
            return $this->redirect(['article/index']);
        }
        return $this->render('add',['article'=>$article,'article_detail'=>$article_detail]);
    }


    public function actionDel($id){
        Article::deleteAll(['id'=>$id]);
        return $this->redirect(['index']);
    }


}
