<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_134329_group_column_rename extends Migration
{
    public function up()
    {
        $this->addPrimaryKey('pk1', 'students_groups', 'groups');
    }

    public function down()
    {
        $this->dropPrimaryKey('pk1', 'students_groups');
    }
}
