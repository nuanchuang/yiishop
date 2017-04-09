<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\GoodsDayCount;
use backend\models\GoodsIntro;
use yii\data\Pagination;
use yii\web\UploadedFile;
use xj\uploadify\UploadAction;
use crazyfd\qiniu\Qiniu;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex(){
        $models = Goods::find();
        $pages = new Pagination([
            'totalCount' => $models->count(),
            'pageSize' => 5,
        ]);
        $models = $models->limit($pages->limit)->offset($pages->offset)->all();
        return $this->render('index',['models'=>$models,'pages'=>$pages]);
    }

    public function actionAdd(){
        $model = new Goods();
        $goods_intro = new GoodsIntro();

        if($model->load(\Yii::$app->request->post())
        && $goods_intro->load(\Yii::$app->request->post())){
        $model->logo_file = UploadedFile::getInstance($model,'logo_file');
            if($model->validate() && $goods_intro->validate()){
                //验证图片并保存
                if($model->logo_file){
                    $fileName = 'upload/logo/'.uniqid().'.'.$model->logo_file->extension;
                    $model->logo_file->saveAs($fileName,false);
                    $model->logo = $fileName;
                }

                //自动生成sn
                $day = date('Y-m-d');
                $goodsCount = GoodsDayCount::findOne(['day'=>$day]);
                if($goodsCount == null){
                    $goodsCount = new GoodsDayCount();
                    $goodsCount->day = $day;
                    $goodsCount->count = 0;
                    $goodsCount->save();
                }

                $model->sn = date('Ymd').sprintf("%04d",$goodsCount->count+1);
                $model->save();
                $goods_intro->goods_id = $model->id;
                $goods_intro->save();
                GoodsDayCount::updateAllCounters(['count'=>1],['day'=>$day]);


                \Yii::$app->session->setFlash('success','添加商品成功,请添加相册');
                return $this->redirect('goods/logo',['id'=>$model->id]);
            }
//            $model->save();
//            $goods_intro->goods_id = $model->id;
            $goods_intro->save();
            \Yii::$app->session->setFlash('添加成功');
            return $this->render('logo');

        }
        return $this->render('add',['model'=>$model,'goods_intro'=>$goods_intro]);
    }


    public function actionEdit($id){
        $model = Goods::findOne(['id'=>$id]);
        $goods_intro = new GoodsIntro();
        return $this->render('add',['model'=>$model,'goods_intro'=>$goods_intro]);
    }



    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload/logo',
                'baseUrl' => '@web/upload/logo',
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

    public function actionLogo($id){
        $goods = Goods::findOne(['id'=>$id]);
        if($goods == null){
            return '商品不存在';
        }
        return $this->render('logo',['goods' => $goods]);
    }


    //获取本地IP
    public function actionIp(){
//        $ip = $_SERVER["REMOTE_ADDR"];
//        return $ip;
        $ip = \Yii::$app->request->userIP;
        return $ip;
    }


    public function actionTest(){
//        $fileName = \Yii::getAlias('@webroot');
//        var_dump($fileName);
//        exit;
        $ak = '4KMtEGBmms54oJu6Hu3F8bF_JjI2DEhDXkJn5rdH';
        $sk = 'ILsrCtjLy-BFPQPHB01EnqqCkXF7FHzv95xNWn1G';
        $domain = 'http://onk4qj29g.bkt.clouddn.com/';
        $bucket = ' z-yiishop';
        $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
        $key = time();
        $fileName = \Yii::getAlias('@webroot').'upload/test/z.jpg';
        $qiniu->uploadFile($fileName,$key);
        $url = $qiniu->getLink($key);
        return $url;
    }
}
