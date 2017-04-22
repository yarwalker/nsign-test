<?php

use yii\db\Migration;

class m170421_115901_create_table_dishes extends Migration
{
    public $table_name = 'dishes';

    public function up()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'description' => $this->text(),
        ]);
    }

    public function down()
    {
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
