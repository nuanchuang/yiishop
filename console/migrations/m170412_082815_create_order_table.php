<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170412_082815_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer(11)->notNull()->defaultValue(0)->comment('会员ID'),
            'name' => $this->string(20)->notNull()->comment('收货人'),
            'province_name' => $this->string(30)->notNull()->defaultValue(0)->comment('省份'),
            'city_name' => $this->string(30)->notNull()->defaultValue(0)->comment('城市'),
            'area_name' => $this->string(30)->notNull()->defaultValue(0)->comment('区县'),
            'detail_address' => $this->string(40)->notNull()->defaultValue(0)->comment('详细地址'),
            'tel' => $this->char(11)->notNull()->comment('手机号'),
            'delivery_id' => $this->integer(3)->notNull()->defaultValue(0)->comment('配送方式ID'),
            'delivery_name' => $this->string(30)->comment('配送方式名字'),
            'delivery_price' => $this->decimal(7,2)->notNull()->defaultValue(0.00)->comment('运费'),
            'pay_type_id' => $this->integer(3)->unsigned()->notNull()->defaultValue(1)->comment('支付方式'),
            'pay_type_name' => $this->integer(30)->notNull()->defaultValue(1)->comment('支付方式名称'),
            'price' => $this->decimal(10,2)->notNull()->defaultValue(0.00)->comment('商品金额'),
            'status' => $this->integer(4)->notNull()->defaultValue(1)->comment('订单状态 0已取消 1待付款 2待发货 3待收货 4完成'),
            'trade_no' => $this->char(30)->notNull()->comment('第三方支付的交易号'),
            'create_time' => $this->integer(30)->unsigned()->notNull()->defaultValue(0)->comment('订单创建时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
