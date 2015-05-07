<?php

use yii\db\Schema;
use yii\db\Migration;

class m150422_102359_create_table_students_groups extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('students_groups', [
            'group' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('students_groups');
    }
}
