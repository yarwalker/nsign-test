<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_status`.
 */
class m170331_173931_create_user_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('user_status', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'state' => $this->string()->notNull(),
        ]);

        $this->insert('user_status', [
            'id' => 0, 'title' => 'Заблокирован', 'state' => 'BLOCKED',
        ]);
        $this->insert('user_status', [
            'id' => 10, 'title' => 'Активен', 'state' => 'ACTIVE',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('user_status');
    }
}
