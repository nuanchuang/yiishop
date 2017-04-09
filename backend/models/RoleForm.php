<?php
namespace backend\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class RoleForm extends Model{
    public $name;//角色名称
    public $description;//描述
    public $permissions;//权限

    const SCENARIO_ADD = 'add';//添加场景

    public function rules(){
        return [
            [['name','description'],'required'],//不能为空
            [['name'],'validateName','on'=>self::SCENARIO_ADD],//自定义规则，权限名不能重复,只在添加时作用
            [['permissions'],'safe'],//安全
        ] ;
    }
    public function attributeLabels(){
        return [
            'name' => '角色名',
            'description' => '简介',
            'permissions' => '权限',
        ];
    }



    //自定义方法，设置权限名不能重复  $a为name属性，$b为条件
    public function validateName($a,$b){
        $authManager = \Yii::$app->authManager;//调用组件
        if($authManager->getRole($this->$a)){//判断权限是否存在
            $this->addError($a,'角色名已存在');//添加错误信息
        }
    }



    //获取所有权限，转换成数组选项
    public static function getPermissions(){
        $authManager = \Yii::$app->authManager;//实例化组件
        $permissions = $authManager->getPermissions();//获取所有权限信息
        return ArrayHelper::map($permissions,'name','description');//转换成数组选项
    }
}