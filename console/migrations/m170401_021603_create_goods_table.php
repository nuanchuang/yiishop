<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m170401_021603_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('名称'),
            'sn' => $this->char(15)->notNull()->comment('货号'),
            'logo' => $this->string(150)->notNull()->comment('商品LOGO'),
            'goods_category_id' => $this->integer(3)->unsigned()->notNull()->defaultValue(0)->comment('商品分类'),
            'brand_id' => $this->integer(5)->unsigned()->notNull()->defaultValue(0)->comment('品牌'),
            'market_price' => $this->decimal(10,2)->unsigned()->notNull()->defaultValue(0.00)->comment('市场价格'),
            'shop_price' => $this->decimal(10,2)->unsigned()->notNull()->defaultValue(0.00)->comment('本店价格'),
            'stock' => $this->integer(11)->notNull()->defaultValue(0)->comment('库存'),
            'is_on_sale' => $this->integer(4)->notNull()->defaultValue(1)->comment('是否上架：1为是，0为否'),
            'status' => $this->integer(4)->notNull()->defaultValue(1)->comment('状态：1为正常，0为回收站'),
            'sort' => $this->integer(4)->notNull()->defaultValue(20)->comment('排序'),
            'inputtime' => $this->integer(11)->notNull()->defaultValue(0)->comment('录入时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
