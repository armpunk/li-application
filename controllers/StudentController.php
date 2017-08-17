<?php

namespace app\controllers;

use app\models\Student;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use Yii;


class StudentController extends \yii\web\Controller
{
    public function beforeAction($action) {
        parent::beforeAction($action);
        
        if (Yii::$app->user->isGuest) {
            $this->redirect(Url::to(['/user/login']));
            Yii::$app->response->send();
            return true;
        }
        return true;
    }
    
    public function actionIndex()
    {
        $studentsProvider = new ActiveDataProvider([
            'query' => Student::find()
                ->orderBy(['full_name' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20
            ],
        ]);
        
        return $this->render('index', [
            'studentsProvider' => $studentsProvider
        ]);
    }
    
    public function actionAddStudent() {
        $student = new Student();
        
        if (Yii::$app->request->isPost) {
            $student->load(Yii::$app->request->post());
            //2017-08-14 00:00:00
            $student->created_at = Yii::$app->formatter
                    ->asDatetime('now', 'php:Y-m-d H:i:s');
            $student->updated_at = Yii::$app->formatter
                    ->asDatetime('now', 'php:Y-m-d H:i:s');
            
            if ($student->save()) {
                Yii::$app->session->setFlash('success', 
                        $student->full_name.' record has been added');
                
                $student = new Student();
                
            } 
            
        }
        
        return $this->render('add', [
            'studentModel' => $student
        ]);
    }
    
    public function actionViewStudent($id) {
        //$student = Student::find()->where(['id' => $id])->one();
        $student = Student::findOne(['id' => $id]);
        
        return $this->render('view', [
            'student' => $student
        ]);
        
    }
    
    public function actionUpdate($id) {
        $student = Student::findOne(['id' => $id]);
        
        if (Yii::$app->request->isPost) {
            $student->load(Yii::$app->request->post());
            //2017-08-14 00:00:00
          
            $student->updated_at = Yii::$app->formatter
                    ->asDatetime('now', 'php:Y-m-d H:i:s');
            
            if ($student->update()) {
                Yii::$app->session->setFlash('success', 
                        $student->full_name.' record has been updated');
                
            } 
            
        }
        
        return $this->render('update', [
            'studentModel' => $student
        ]);
    }
    
    public function actionDelete($id) {
        $student = Student::findOne(['id' => $id]);
        $student_name = $student->full_name;
        $student->delete();
        
        Yii::$app->session->setFlash('success', 
                        $student_name .' record has been deleted.');
        
        $this->redirect(Url::to(['/student/index']));
        Yii::$app->response->send();
    }

}
