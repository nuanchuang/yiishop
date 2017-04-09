<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m170406_060238_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(10)->comment('上级分类'),
            'name' => $this->string(50)->comment('名称'),
            'url' => $this->string(50)->comment('路由'),
            'description' => $this->string(100)->comment('描述')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
