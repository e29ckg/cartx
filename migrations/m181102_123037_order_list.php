<?php

use yii\db\Migration;

/**
 * Class m181102_123037_order_list
 */
class m181102_123037_order_list extends Migration
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
        $this->createTable('order_list', [
            'id' => $this->primaryKey(),
            'id_order' => $this->string(32)->notNull(),
            'id_product' => $this->string(),
            'quantity' => $this->integer(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);

        $this->insert('order_list', [
            'id_order' => 1,
            'id_product' => 1,
            'quantity' => 2,
            'create_at' => date("Y-m-d H:i:s"),
        ]);
        $this->insert('order_list', [
            'id_order' => 1,
            'id_product' => 2,
            'quantity' => 2,
            'create_at' => date("Y-m-d H:i:s"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181102_123037_order_list cannot be reverted.\n";
        $this->dropTable('order_lists');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181102_123037_order_list cannot be reverted.\n";

        return false;
    }
    */
}
