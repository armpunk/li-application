<?php

namespace app\models;
use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property integer $department_id
 * @property integer $student_id
 * @property string $date_applied
 * @property integer $status
 * @property integer $approved_by
 *
 * @property User $approvedBy
 * @property Department $department
 * @property Student $student
 */
class Application extends \yii\db\ActiveRecord
{
    
    const APP_PENDING = 0;
    const APP_APPROVED = 1;
    const APP_REJECTED = 2;
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id', 'student_id', 'date_applied'], 'required'],
            [['department_id', 'student_id', 'status', 'approved_by'], 'integer'],
            [['date_applied'], 'safe'],
            [['approved_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['approved_by' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'department_id' => Yii::t('app', 'Department ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'date_applied' => Yii::t('app', 'Date Applied'),
            'status' => Yii::t('app', 'Status'),
            'approved_by' => Yii::t('app', 'Approved By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprovedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'approved_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @inheritdoc
     * @return ApplicationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApplicationQuery(get_called_class());
    }
    
    
}
