<?php

namespace backend\controllers;

use backend\models\Admin;
//use backend\models\Login;
use common\models\LoginForm;
use yii\data\Pagination;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Admin::find();
        $pages = new Pagination([
            'totalCount' => $models->count(),
            'pageSize' => 4
        ]);
        $models = $models->limit($pages->limit)->offset($pages->offset)->all();
        return $this->render('index',['models'=>$models,'pages'=>$pages]);
    }

    public function actionAdd(){
        $model = new Admin();
        if($model->load(\Yii::$app->request->post())){
            if($model->validate()){
                $model->password = md5($model->password);
                $model->salt = \Yii::$app->security->generateRandomString();
//                var_dump($model->salt);
//                exit;
                $model->last_login_ip = $_SERVER['REMOTE_ADDR'];
                $model->add_time = time();
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                \Yii::$app->user->login($model);
                return $this->redirect('index');
            }
        }
        return $this->render('add',['model'=>$model]);
    }


    public function actionEdit($id){
        $model = Admin::findOne(['id'=>$id]);
        $model->password = '';
        if($model->load(\Yii::$app->request->post())){
            if($model->validate()){
                $model->password = md5($model->password);
                $model->salt = \Yii::$app->security->generateRandomString();
                $model->last_login_ip = $_SERVER['REMOTE_ADDR'];
//                $model->add_time = time();
                $model->save();
                \Yii::$app->session->setFlash('success','编辑成功');
                return $this->redirect('index');
            }
        }
        return $this->render('add',['model'=>$model]);
    }


    public function actionDel($id){
        Admin::deleteAll(['id'=>$id]);
        return $this->redirect('index');
    }



    public function actionLogin(){
        $model = new Admin();
        if($model->load(\Yii::$app->request->post())){
            if($model->validate()){
                echo "111";
            }else{
                var_dump($model->getErrors());
                exit;
            }
        }
        return $this->render('login',['model'=>$model]);
    }
}
