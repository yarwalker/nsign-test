<?php

use yii\db\Migration;

class m170421_120407_create_table_dishes_ingridients extends Migration
{
    public $table_name = 'dishes_ingridients';

    public function safeUp()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'dish_id' => $this->integer()->notNull(),
            'ingridient_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-dishes-id', $this->table_name, 'dish_id', 'dishes', 'id',
            'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-ingridients-id', $this->table_name, 'ingridient_id', 'ingridients', 'id',
            'CASCADE', 'CASCADE');

        $this->createIndex('ixDishes', $this->table_name, 'dish_id');
        $this->createIndex('ixIngridients', $this->table_name, 'ingridient_id');
    }

    public function safeDown()
    {
        $this->dropIndex('ixDishes', $this->table_name);
        $this->dropIndex('ixIngridients', $this->table_name);

        $this->dropForeignKey(
            'fk-dishes-id',
            $this->table_name
        );

        $this->dropForeignKey(
            'fk-ingridients-id',
            $this->table_name
        );

        $this->dropTable($this->table_name);

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
