<?php
namespace backend\filters;

use yii\base\ActionFilter;
use yii\web\HttpException;

class AccessFilter extends ActionFilter{
    public function beforeAction($action){
        //判断权限
        //当前用户是否有当前操作的权限
        //can方法判断
        //action是当前操作的对象
        if(!\Yii::$app->user->can($action->uniqueId)) {

            //无权限时跳转到登陆界面
            if(\Yii::$app->user->isGuest){
                return $action->controller->redirect(\Yii::$app->user->loginUrl);
            }


            //抛出403异常
            throw new HttpException(403,'抱歉，没权限了~');
            return false;//禁止操作继续执行
        }
    }

}