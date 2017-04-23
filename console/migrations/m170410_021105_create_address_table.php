<?php

use yii\db\Migration;

/**
 * Handles the creation of table `address`.
 */
class m170410_021105_create_address_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('收货人：'),
            'address' => $this->string()->notNull()->comment('详细地址：'),
            'tel' => $this->integer(11)->comment('手机号码：'),
            'status' => $this->string(3)->comment('是否默认')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('address');
    }
}
