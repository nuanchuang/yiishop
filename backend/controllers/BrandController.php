<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Request;
use yii\web\UploadedFile;
use xj\uploadify\UploadAction;

class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Brand::find();

        $pages = new Pagination([
            'totalCount' => $models->count(),
            'pageSize' => 3
        ]);

        $models = $models->limit($pages->limit)->offset($pages->offset)->all();
        return $this->render('index',['models'=>$models,'pages'=>$pages]);
    }

    //添加品牌
    public function actionAdd(){
        $model = new Brand();

        $request = \Yii::$app->request;
//        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['brand/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }


    public function actionEdit($id){
        $model = Brand::findOne(['id'=>$id]);

        $request = \Yii::$app->request;
//        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
//            var_dump($model);
//            exit;
            //实例化一个上传对象
//            $model->logo_file = UploadedFile::getInstance($model,'logo_file');
            if($model->validate()) {
//            if($model->logo_file){
//                //设置保存文件名和地址
//                $fileName = 'Upload/brand/'.uniqid().'.'.$model->logo_file->extension;
//                //保存文件
//                $model->logo_file->saveAs($fileName,false);
//                $model->logo = $fileName;
//            }
//            var_dump($model);
//            exit;
//            $model->save();
                $model->save();
//            var_dump($model);
//            exit;
                \Yii::$app->session->setFlash('success', '修改成功');
                return $this->redirect(['brand/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }

    public function actionDel($id){
        //找到需要删除的指定ID的数据
        $model = Brand::findOne(['id'=>$id]);
        //将status的值设定为-1
        if($model->status != -1){
            $model->status = -1;
        }
        //保存到数据库
        $model->save(false);
//        $sql = "update brand set status=-1 where id =".$id;
//        $model->query($sql);
//        if($model->status === -1){
            //        return $this->redirect(['brand/index']);
//            return $this->render('del',['model'=>$model]);
//        }
        return $this->redirect(['brand/index']);
    }


    //状态切换为隐藏
    public function actionHide($id){
        //找到需要删除的指定ID的数据
        $model = Brand::findOne(['id'=>$id]);
        //将status的值设定为-1
        if($model->status != 0){
            $model->status = 0;
        }
        //保存到数据库
        $model->save(false);
        return $this->redirect(['brand/index']);
    }


    //正常
    public function actionNormal($id){
        //找到需要删除的指定ID的数据
        $model = Brand::findOne(['id'=>$id]);
        //将status的值设定为-1
        if($model->status != 1){
            $model->status = 1;
        }
        //保存到数据库
        $model->save(false);
        return $this->redirect(['brand/index']);
    }

//    public function actionDelete($id){
//        Brand::deleteAll(['id'=>$id]);
//        return $this->redirect(['brand/del']);
//    }

//上传文件需要的样式
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload/brand',
                'baseUrl' => '@web/upload/brand',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }
}
