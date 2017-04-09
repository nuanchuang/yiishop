<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $article_category_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property string $inputtime
 */
class Article extends \yii\db\ActiveRecord
{

    public static $status = [1=>'正常',0=>'删除'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'article_category_id','status','sort'], 'required'],
            [['article_category_id', 'status', 'sort', 'inputtime'], 'integer'],
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
            'name' => '名称',
            'article_category_id' => '文章分类',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '录入时间',
        ];
    }

    public function getCategory(){
        return $this->hasOne(Articlecategory::className(),['article_category_id'=>'id']);
    }

    public static function getClass(){
        $class = Articlecategory::find()->where(['status'=>1])->asArray()->all();
        return ArrayHelper::map($class,'id','name');
    }
}
