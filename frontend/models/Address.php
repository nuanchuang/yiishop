<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $tel
 * @property string $status
 */
class Address extends \yii\db\ActiveRecord
{
    public $province;//省份
    public $city;//市级
    public $area;//县级
    public static $status = [1=>'是',0=>'否'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required'],
            [['tel'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 3],
            [['province','city','area'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '收货人：',
            'address' => '详细地址：',
            'tel' => '手机号码：',
            'status' => '设为默认',
        ];
    }


    public function select(){

    }
}
