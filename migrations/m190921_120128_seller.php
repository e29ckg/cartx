<?php

use yii\db\Migration;

/**
 * Class m190921_120128_seller
 */
class m190921_120128_seller extends Migration
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
        $this->createTable('seller', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->string(),
            'phone' => $this->string()
        ], $tableOptions);   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('seller');

        return false;
    }

    
}
