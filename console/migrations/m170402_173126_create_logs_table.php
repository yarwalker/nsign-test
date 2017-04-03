<?php

use yii\db\Migration;

/**
 * Handles the creation of table `logs`.
 */
class m170402_173126_create_logs_table extends Migration
{
    private $table_name = 'logs';
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'object' => $this->string(100)->notNull(),
            'object_name' => $this->string(100)->notNull(),
            'field' => $this->string(100)->notNull(),
            'old_value' => $this->string()->notNull(),
            'new_value' => $this->string()->notNull(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->table_name);
    }
}
