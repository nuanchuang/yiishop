<?php
namespace backend\models;

use yii\base\Model;

class PermissionForm extends Model{
    public $name;//名称
    public $description;//描述
//    public $permission;//权限



    public function rules(){
        return [
            [['name','description'],'required'],//不能为空
            [['name'],'validateName'],//自定义规则，权限名不能重复
//            [['permission'],'safe'],//安全
        ] ;
    }
    public function attributeLabels(){
        return [
            'name' => '名称',
            'description' => '描述',
        ];
    }

    //自定义方法，设置权限名不能重复  $a为name属性，$b为条件
    public function validateName($a,$b){
        $authManager = \Yii::$app->authManager;//调用组件
        if($authManager->getPermission($this->$a)){//判断权限是否存在
            $this->addError($a,'权限名已存在');//添加错误信息
        }
    }
}