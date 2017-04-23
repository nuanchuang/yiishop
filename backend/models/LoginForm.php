<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 10:38
 */

namespace frontend\models;


use backend\models\Admin;
use yii\base\Model;

class LoginForm extends Model
{
    public  $username;//用户名
    public  $password;//密码

    public function rules()
    {
        return [
            [['username','password'],'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码'
        ];
    }

    /*
     * 登录
     */
    public function login()
    {
        if($this->validate()){
            //> 2.1 先根据用户名查找用户
            $account = Admin::findOne(['username'=>$this->username]);
            if($account){
                //>2.2 对比密码
                //验证密码
                if(\Yii::$app->security->validatePassword($this->password,$account->password)){
                    //3 保存用户信息到session
                    \Yii::$app->user->login($account);
                    return true;
                }else{
                    //密码错误
                    //\Yii::$app->session->setFlash('danger','密码错误');
                    $this->addError('password','密码错误');//添加错误信息
                }
            }else{
                //用户名不存在
                // \Yii::$app->session->setFlash('danger','用户名不存在');
                $this->addError('username','用户名不存在');
            }
        }
        return false;
    }
}