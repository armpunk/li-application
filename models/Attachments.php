<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attachments".
 *
 * @property integer $id
 * @property string $filepath
 * @property integer $application_id
 *
 * @property Application $application
 */
class Attachments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attachments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filepath', 'application_id'], 'required'],
            [['application_id'], 'integer'],
            [['filepath'], 'string', 'max' => 255],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'filepath' => Yii::t('app', 'Filepath'),
            'application_id' => Yii::t('app', 'Application ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['id' => 'application_id']);
    }

    /**
     * @inheritdoc
     * @return AttachmentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttachmentsQuery(get_called_class());
    }
}
