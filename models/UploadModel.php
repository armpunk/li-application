<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadModel extends Model 
{
    public $attachmentFiles;
    
    public function rules() {
        return [
            [['attachmentFiles'], 'file', 
                'skipOnEmpty' => false, 
                'extensions' => 'docx, pdf, pptx, xlsx',
                'maxFiles' => 3]  
        ];
    }
    
    public function upload() {
        if ($this->validate()) {
            foreach ($this->attachmentFiles as $attachmentFile) {
                $attachmentFile->saveAs('uploads/' 
                        . $attachmentFile->baseName 
                        . '.' 
                        . $attachmentFile->extension);
            }
            return true;
        } else {
            return false;
        }
    }   
    
}

