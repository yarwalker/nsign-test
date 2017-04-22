<?php

use yii\db\Migration;

class m170421_114540_create_table_ingridients extends Migration
{
    public $table_name = 'ingridients';

    public function up()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'state' => "enum('Активен','Скрыт') NOT NULL DEFAULT 'Активен'",
        ]);
    }

    public function down()
    {
        $this->dropTable($this->table_name);

        return false;
    }


}
