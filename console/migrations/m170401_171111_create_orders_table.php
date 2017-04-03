<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m170401_171111_create_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $table_name = 'orders';

        $this->createTable($table_name, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'good_id' => $this->integer(),
            'customer_fio' => $this->string()->notNull(),
            'customer_phone' => $this->string()->notNull(),
            'comments' => $this->text(),
            'status' => "enum('Принята','Отказана','Брак') NOT NULL DEFAULT 'Принята'",
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'updated_by' => $this->integer()
        ]);

        $this->createIndex('good_id-ix', 'orders', 'good_id');

        $this->addForeignKey('fk-goods', 'orders', 'good_id',
                             'goods', 'id', 'SET NULL', 'NO ACTION');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-goods',
            'orders'
        );
        $this->dropTable('orders');
    }
}
