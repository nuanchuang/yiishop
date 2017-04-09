<?php

namespace backend\controllers;

use backend\models\PermissionForm;
use backend\models\RoleForm;

class RbacController extends \yii\web\Controller
{
    //显示
    public function actionIndex()
    {
//        $authManager = \Yii::$app->authManager;
//        $models = PermissionForm::
        $models = \Yii::$app->authManager->getPermissions();//读取权限表的数据
        return $this->render('index',['models'=>$models]);//显示视图
    }


    //添加
    public function actionAddPermission(){
//        $model = \Yii::$app->authManager;
        $model = new PermissionForm();//实例化对象
        if($model->load(\Yii::$app->request->post()) && $model->validate()){//获取数据并进行验证
            $authManager = \Yii::$app->authManager;//调用anthManager组件
            $permission = $authManager->createPermission($model->name);//创建权限名称
            $permission->description = $model->description;//创建权限描述
            if($authManager->add($permission)){//判定是否保存
                \Yii::$app->session->setFlash('success','添加成功');//保存成功
                $this->redirect('index');
            }
        }
        return $this->render('add',['model'=>$model]);
    }


    //删除权限
    public function actionDelPermission($name){
        $authManager = \Yii::$app->authManager;//实例化组件
        $permission = $authManager->getPermissions($name);//获取权限名的权限信息
        $authManager->remove($permission);//移除改条权限
    }









    //角色名展示
    public function actionIndexRole(){
        //实例化组件
        $authManager = \Yii::$app->authManager;
        $models = $authManager->getRoles();
        return $this->render('indexRole',['models'=>$models]);
    }



    //添加角色
    public function actionAddRole(){
//        $model = \Yii::$app->authManager;
        $model = new RoleForm();//实例化对象
        $model->scenario = RoleForm::SCENARIO_ADD;//添加场景
        if($model->load(\Yii::$app->request->post()) && $model->validate()){//获取数据并进行验证
            $authManager = \Yii::$app->authManager;//调用anthManager组件
            $role = $authManager->createRole($model->name);//创建权限名称
            $role->description = $model->description;//创建权限描述
//            if($authManager->add($role)){//判定是否保存
//                \Yii::$app->session->setFlash('success','添加成功');//保存成功
//                $this->redirect('index');
//            }
            $authManager->add($role);//保存到数据库
            //角色关联权限
//            var_dump($model);
//           exit;
            foreach($model->permissions as $permission){
                $authManager->addChild($role,$authManager->getPermission($permission));
            }

            \Yii::$app->session->setFlash('success','添加角色成功');
            return $this->redirect(['rbac/index-role']);
        }
        return $this->render('addRole',['model'=>$model]);
    }




    //修改角色
    public function actionEditRole($name){
//        $model = \Yii::$app->authManager;
        $model = new RoleForm();//实例化对象
        $authManager = \Yii::$app->authManager;//调用anthManager组件
        $role = $authManager->getRole($name);//获取主键所在的整条数据
        $model->name = $role->name;//获取name
        $model->description = $role->description;//获取描述
        $permission = $authManager->getPermissionsByRole($role->name);//根据name获取该条所属的权限
        $model->permissions = array_keys($permission);//获取数组的第一个值，即权限
        if($model->load(\Yii::$app->request->post()) && $model->validate()){//获取数据并进行验证

//            $role = $authManager->createRole($model->name);//创建权限名称
            $role->description = $model->description;//创建权限描述
            $authManager->update($role->name,$role);//更新数据到数据库
            //清除之前的权限，再重新添加
            $authManager->removeChildren($role);
            //角色关联权限
            if($model->permissions){
                foreach($model->permissions as $permission){
                    $authManager->addChild($role,$authManager->getPermission($permission));
                }
            }
            \Yii::$app->session->setFlash('success','角色更新成功');
            return $this->redirect(['rbac/index-role']);
        }
        return $this->render('addRole',['model'=>$model]);
    }




    //移除角色
    public function actionDelRole($name){
        $authManager = \Yii::$app->authManager;
        $role = $authManager->getRole($name);
        $authManager->remove($role);
        return $this->redirect(['index-role']);
    }
}
