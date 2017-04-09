<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_days_count`.
 */
class m170401_021305_create_goods_days_count_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_days_count', [
            'id' => $this->primaryKey(),
            'day' => $this->integer(11)->notNull()->comment('日期'),
            'count' => $this->integer(10)->unsigned()->comment('商品期')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_days_count');
    }
}
