<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $name
 * @property string $province_name
 * @property string $city_name
 * @property string $area_name
 * @property string $detail_address
 * @property string $tel
 * @property integer $delivery_id
 * @property string $delivery_name
 * @property string $delivery_price
 * @property string $pay_type_id
 * @property integer $pay_type_name
 * @property string $price
 * @property integer $status
 * @property string $trade_no
 * @property string $create_time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'delivery_id', 'pay_type_id', 'pay_type_name', 'status', 'create_time'], 'integer'],
            [['name', 'tel', 'trade_no'], 'required'],
            [['delivery_price', 'price'], 'number'],
            [['name'], 'string', 'max' => 20],
            [['province_name', 'city_name', 'area_name', 'delivery_name', 'trade_no'], 'string', 'max' => 30],
            [['detail_address'], 'string', 'max' => 40],
            [['tel'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => '会员ID',
            'name' => '收货人',
            'province_name' => '省份',
            'city_name' => '城市',
            'area_name' => '区县',
            'detail_address' => '详细地址',
            'tel' => '手机号',
            'delivery_id' => '配送方式ID',
            'delivery_name' => '配送方式名字',
            'delivery_price' => '运费',
            'pay_type_id' => '支付方式',
            'pay_type_name' => '支付方式名称',
            'price' => '商品金额',
            'status' => '订单状态 0已取消 1待付款 2待发货 3待收货 4完成',
            'trade_no' => '第三方支付的交易号',
            'create_time' => '订单创建时间',
        ];
    }

    public static $song=[
        1=>['顺丰快递'],
        2=>['京东快递'],
        3=>['EMS'],
    ];


    public static $pay=[
      1=>['货到付款'],
      2=>['支付宝付款'],
      3=>['银行卡付款'],
    ];
}
