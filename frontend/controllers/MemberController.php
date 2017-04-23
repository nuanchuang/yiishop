<?php

namespace frontend\controllers;

use frontend\models\Member;

use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;

class MemberController extends \yii\web\Controller
{
    public $layout = 'login';//指定模板文件



    public function actionIndex()
    {
        return $this->redirect('/index/index');
    }



      public function actionRegister(){
          $model = new Member();

          if($model->load(\Yii::$app->request->post())){
              if($model->password != $model->repassword){
                  \Yii::$app->session->setFlash('danger','密码输入不一致');
//                  return $this->redirect('register');
              };
              if($model->validate()) {
                  $model->password_hash = $model->password;
                  $model->last_login_time = time();
                  $model->last_login_ip = ip2long($_SERVER["REMOTE_ADDR"]);
                  $model->save(false);
                  \Yii::$app->session->setFlash('success', '添加成功');
                  return $this->redirect('index');
              }
          }
          return $this->render('register',['model'=>$model]);
      }

    public function actionLogin(){
        $model = new Member();
        if($model->load(\Yii::$app->request->post())){
            
        }
        return $this->render('login',['model'=>$model]);
    }



    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 4,
                'maxLength' => 4,
            ],
        ];
    }



    public function actionSmsCode(){
        $tel = \Yii::$app->request->post('tel');//获取电话号码
        echo $tel;
        exit;
        $code = rand(1000,9999);//生成随机的验证码
        \Yii::$app->session->set('Tel-'.$tel,$code);//保存到session
    }


    /*
    App Key:   23746186
    App Secret:  cc3c69c530158f005f1419c97b216e03
    */


    public function actionSms($tel){
// 配置信息
        $config = [
            'app_key'    => '23746186',
            'app_secret' => 'cc3c69c530158f005f1419c97b216e03',
            // 'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];
// 使用方法一
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;

        $req->setRecNum($tel)
            ->setSmsParam([
                'num' => rand(100000, 999999)
            ])
            ->setSmsFreeSignName('php学习')
            ->setSmsTemplateCode('SMS_60945169');

        $resp = $client->execute($req);
        var_dump($resp);
    }
}
