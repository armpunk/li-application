<?php

use yii\db\Migration;

class m170814_065531_fix_table_student extends Migration
{
    public function safeUp()
    {
        $this->addColumn("student", "ic_no", 
                $this->string(12)->notNull()->after("full_name"));
    }

    public function safeDown()
    {
        $this->dropColumn("student", "ic_no");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170814_065531_fix_table_student cannot be reverted.\n";

        return false;
    }
    */
}
