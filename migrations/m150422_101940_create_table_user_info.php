<?php

use yii\db\Schema;
use yii\db\Migration;

class m150422_101940_create_table_user_info extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('user_info', [
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'first_name' => Schema::TYPE_STRING,
            'last_name' => Schema::TYPE_STRING,
            'middle_name' => Schema::TYPE_STRING,
            'group' => Schema::TYPE_STRING,
            'tarif' => Schema::TYPE_STRING,
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('user_info');
    }
}
