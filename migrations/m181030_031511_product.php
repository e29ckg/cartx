<?php

use yii\db\Migration;

/**
 * Class m181030_031511_product
 */
class m181030_031511_product extends Migration
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
            'unit' => $this->integer(),
            'Description' => $this->string(),
            'location'=> $this->string(),
            'price' => $this->integer(),
            'status' => $this->smallInteger(),
            'lower' => $this->integer(),
            'instoke' => $this->integer(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);

        $this->insert('product', [
            'product_name' => 'name',
            'code' => Yii::$app->security->generateRandomString(10),
            'img' => '',
            'category' => 1,
            'unit' => 1,
            'Description' => '',
            'location'=> 'A2',
            'price' => 500,
            'status' => 1,
            'lower' => 10,
            'instoke' => 100,
            'create_at' => date("Y-m-d H:i:s"),
        ]);
        
        $this->insert('product', [
            'product_name' => 'name22',
            'code' => Yii::$app->security->generateRandomString(10),
            'img' => '',
            'category' => 1,
            'unit' => 1,
            'Description' => '',
            'location'=> 'A1',
            'price' => 500,
            'status' => 1,
            'lower' => 10,
            'instoke' => 100,
            'create_at' => date("Y-m-d H:i:s"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181030_031511_product cannot be reverted.\n";
        $this->dropTable('product');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_031511_product cannot be reverted.\n";

        return false;
    }
    */
}
