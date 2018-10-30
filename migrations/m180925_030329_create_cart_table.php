<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180924_030329_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
 
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
 
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'product_name' => $this->string()->notNull()->unique(),
            'code' => $this->string(32)->notNull(),
            'img' => $this->string(),
            'category' => $this->integer(),
            'Description' => $this->string()->notNull()->unique(),
            'location'=> $this->string(),
            'price' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'lower' => $this->integer()->notNull(),
            'instoke' => $this->integer(),
            'create_at' => $this->integer(),
        ], $tableOptions);

        $this->insert('product', [
            'id' => '1','username' => 'admin','auth_key' => Yii::$app->security->generateRandomString(),'password_hash' => Yii::$app->security->generatePasswordHash('admin'),'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),'email' => 'e29ckg@gmail.com','role'=>'9',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
    }
}
