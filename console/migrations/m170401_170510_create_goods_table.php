<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m170401_170510_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $table_name = 'goods';

        $this->createTable($table_name, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->float(2)->notNull()
        ]);

        $this->insert($table_name, [
            'name' => 'Яблоки', 'price' => 3.60,
        ]);
        $this->insert($table_name, [
            'name' => 'Апельсины', 'price' => 5.35,
        ]);
        $this->insert($table_name, [
            'name' => 'Мандарины', 'price' => 4.80,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('goods');
    }
}
