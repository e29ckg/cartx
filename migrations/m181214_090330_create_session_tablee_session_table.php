<?php

use yii\db\Migration;

/**
 * Handles the creation of table `session_tablee_session`.
 */
class m181214_090330_create_session_tablee_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('session', [
            'id' => $this->char(40)->notNull(),
            'expire' => $this->integer(),
            'data' => $this->binary(),
            'user_id' => $this->integer()
        ]);

        $this->addPrimaryKey('session_pk', 'session', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('session');
    }
}
