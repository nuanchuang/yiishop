<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170329_071445_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('名称'),
            'intro' => $this->text()->comment('简介'),
            'status' => $this->integer()->notNull()->defaultValue(1)->comment('状态'),
            'sort' => $this->integer()->notNull()->defaultValue(20)->comment('排序'),
            'is_help' => $this->integer()->notNull()->defaultValue(1)->comment('是否是帮助相关的分类')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
