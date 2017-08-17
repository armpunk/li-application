<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attachments`.
 */
class m170817_063826_create_attachments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('attachments', [
            'id' => $this->primaryKey(),
            'filepath' => $this->string()->notNull(),
            'application_id' => $this->integer()->notNull() 
        ]);
        
        $this->createIndex('application_id_idx', 'attachments', 'application_id');
        
        $this->addForeignKey('application_id_fk', 'attachments', 'application_id', 
                'application', 'id', 'RESTRICT', 'RESTRICT');
        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('application_id_fk', 'attachments');
        $this->dropIndex('application_id_idx', 'attachments');
        $this->dropTable('attachments');
    }
}
