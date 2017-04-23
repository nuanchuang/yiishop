<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m170412_082049_create_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer(10)->unsigned()->notNull()->defaultValue(0)->comment('商品'),
            'amount' => $this->integer(10)->unsigned()->notNull()->defaultValue(0)->comment('数量'),
            'member_id' => $this->integer(10)->unsigned()->notNull()->defaultValue(0)->comment('用户ID')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cart');
    }
}
