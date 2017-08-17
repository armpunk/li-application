<?php

use yii\db\Migration;

/**
 * Handles the creation of table `department`.
 */
class m170814_070735_create_department_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('department', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'create_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('department');
    }
}
