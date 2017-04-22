<?php

namespace backend\models;


use backend\components\GoodsCategoryQuery;
use Yii;
use creocoder\nestedsets\NestedSetsBehavior;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property integer $parent_id
 * @property string $intro
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],
            [['tree', 'lft', 'rgt', 'depth', 'parent_id'], 'integer'],
            [['intro'], 'string'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => '分类',
            'lft' => '左边界',
            'rgt' => '右边界',
            'depth' => '深度',
            'name' => '名称',
            'parent_id' => '所属分类',
            'intro' => '简介',
        ];
    }


    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }


    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    public static function find()
    {
        return new GoodsCategoryQuery(get_called_class());
    }

    //创建顶级分类
    public static function getZNodes(){
        return array_merge([['id'=>0,'parent_id'=>0,'name'=>'顶级分类']],self::find()->asArray()->all());
    }


    //获取自身表的二级分类
    public function getChildren(){
        return $this->hasMany(self::className(),['goods_id'=>'id']);
    }

}
