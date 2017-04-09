<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $url
 * @property string $description
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'safe'],
            [['name', 'url'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '所属分类',
            'name' => '名称',
            'url' => '链接',
            'description' => '描述',
        ];
    }

        public static function getClass(){
            $class = Menu::find()->where(['parent_id'=>0])->asArray()->all();
            $b= ArrayHelper::map($class,'id','name');
            $a = [
                '0'=>'顶级分类',
            ];
            return array_merge($a,$b);
//            var_dump(ArrayHelper::map($class,'id','name'));
//            exit;

        }

//    public function getPermission(){
//        $authManager = Yii::$app->authManager->getPermissions();
//        var_dump($authManager);
//    }

}
