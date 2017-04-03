<?php

use yii\db\Migration;

class m170402_175141_alter_orders_table_add_price extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'price', 'double');
    }

    public function down()
    {
        echo "m170402_175141_alter_orders_table_add_price cannot be reverted.\n";
        $this->dropColumn('orders', 'price');
        //return false;
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
