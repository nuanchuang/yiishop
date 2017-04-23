<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member`.
 */
class m170409_060927_create_member_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('member', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
//            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'tel' => $this->char(11)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'last_login_time' => $this->integer(),
            'last_login_ip' => $this->integer(),
//            'created_at' => $this->integer(),
//            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('member');
    }
}
