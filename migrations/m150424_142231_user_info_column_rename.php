<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_142231_user_info_column_rename extends Migration
{
    public function up()
    {
        $this->addPrimaryKey('pk1', 'user_info', 'username');
    }

    public function down()
    {
        $this->dropPrimaryKey('pk1', 'user_info');
    }
}
