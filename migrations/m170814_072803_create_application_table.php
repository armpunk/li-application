<?php

use yii\db\Migration;

/**
 * Handles the creation of table `application`.
 */
class m170814_072803_create_application_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('application', [
            'id' => $this->primaryKey(),
            'department_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'date_applied' => $this->date()->notNull(),
            'status' => $this->smallInteger(1)->notNull()
                ->defaultValue(0),
            'approved_by' => $this->integer()
        ]);
        
         //create index for approved_by
        $this->createIndex("department_id_idx", 
                "application", "department_id");
        
         //create index for approved_by
        $this->createIndex("student_id_idx", 
                "application", "student_id");
        
        //create index for approved_by
        $this->createIndex("approved_by_idx", 
                "application", "approved_by");
        
        //student-application relationship
        $this->addForeignKey("student_id_fk", "application", 
                "student_id", "student", "id", "RESTRICT", 
                "RESTRICT");
        
         //student-application relationship
        $this->addForeignKey("department_id_fk", "application", 
                "department_id", "department", "id", "RESTRICT", 
                "RESTRICT");
        
        //student-application relationship
        $this->addForeignKey("approved_by_fk", "application", 
                "approved_by", "user", "id", "RESTRICT", 
                "RESTRICT");
        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey("approved_by_fk", "application");
        $this->dropForeignKey("department_id_fk", "application");
        $this->dropForeignKey("student_id_fk", "application");
        $this->dropIndex("approved_by_idx", "application");
        $this->dropIndex("student_id_idx", "application");
        $this->dropIndex("department_id_idx", "application");
        $this->dropTable('application');
    }
}
