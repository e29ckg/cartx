<?php

use yii\db\Migration;

/**
 * Class m181121_152347_receipt_list
 */
class m181121_152347_receipt_list extends Migration
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
        $this->createTable('receipt_list', [
            'id' => $this->primaryKey(),
            'receipt_code' => $this->string(32)->notNull(),
            'product_code' => $this->string(),
            'product_unit_id' => $this->integer(),
            'unit_price' => $this->float(),
            'quantity' => $this->integer(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);

        $this->insert('receipt_list', [
            'receipt_code' => 'R1234567890',
            'product_code' => 'P0987654321',
            'product_unit_id' => 1,
            'unit_price' => 300,
            'quantity' => 100,
            'create_at' => date("Y-m-d H:i:s"),
        ]);

        $this->insert('receipt_list', [
            'receipt_code' => 'R1234567890',
            'product_code' => 'P1234567890',
            'product_unit_id' => 1,
            'unit_price' => 300,
            'quantity' => 100,
            'create_at' => date("Y-m-d H:i:s"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181121_152347_receipt_list cannot be reverted.\n";
        $this->dropTable('receipt_list');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_152347_receipt_list cannot be reverted.\n";

        return false;
    }
    */
}
