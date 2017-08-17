<?php

namespace app\controllers;

use app\models\Student;
use app\models\Department;
use Yii;
use app\models\UploadModel;
use yii\web\UploadedFile;
use app\models\Attachments;
use yii\helpers\Url;

class ApplyController extends \yii\web\Controller {

    public function actionIndex() {
        $studentModel = new Student();
        $uploadModel = new UploadModel();

        if (Yii::$app->request->isPost) {

            $studentModel->load(Yii::$app->request->post());
            $studentModel->created_at = Yii::$app->formatter
                    ->asDatetime('now', 'php:Y-m-d H:i:s');
            $studentModel->updated_at = Yii::$app->formatter
                    ->asDatetime('now', 'php:Y-m-d H:i:s');

            if ($studentModel->save()) {
                $student_id = $studentModel->id;

                $departmentIds = Yii::$app->request->post('departments');

                foreach ($departmentIds as $departmentId) {
                    $application = new \app\models\Application();
                    $application->department_id = $departmentId;
                    $application->student_id = $student_id;
                    $application->date_applied = Yii::$app->formatter
                            ->asDate('now', 'php:Y-m-d');

                    if ($application->save()) {
                        Yii::$app->session->setFlash('success', 'LI Application has been submitted. Please check your '
                                . 'email from time to time.');

                        $studentModel = new Student();
                    } else {
                        $studentModel->delete();
                    }
                }

                $uploadModel->attachmentFiles = UploadedFile::getInstance($uploadModel, 'attachmentFiles');

                if ($uploadModel->upload()) {
                    foreach ($uploadModel->attachmentFiles as $attachment) {
                        $attachmentsModel = new Attachments();
                        $attachmentsModel->filepath = Url::to(['/uploads/'
                                    . $attachment->baseName
                                    . '.'
                                    . $attachment->extension]);
                        $attachmentsModel->application_id = "";
                        $attachmentsModel->save();
                    }
                }
            }
        }

        return $this->render('index', [
                    'studentModel' => $studentModel,
                    'uploadModel' => $uploadModel
        ]);
    }

    public function actionCheck($ic_no = null) {

        $applicationsModel = null;
        $hasApplication = true;

        if (!is_null($ic_no)) {
            $student = Student::find()->where(['ic_no' => $ic_no]);
            // student exist
            if ($student->exists()) {
                if ($student->one()->getApplications()->exists()) {
                    $applicationsModel = $student->one()->getApplications()->all();
                    $hasApplication = true;
                } else {
                    $hasApplication = false;
                }
                $student = $student->one();
            } else {
                $student = null;
            }
        } else {
            $student = new Student();
        }

        return $this->render('check', [
                    'applicationModel' => $applicationsModel,
                    'student' => $student,
                    'hasApplication' => $hasApplication
        ]);
    }

    public function actionTest() {
        echo "<pre>";

        $students = Student::find()
                ->orderBy(['created_at' => SORT_DESC])
                //->asArray()
                ->one();

        //$dept1 = $students->applications[0]->department->name;
        //$dept2 = $students->applications[1]->department->name;
        //$dept3 = $students->applications[2]->department->name;

        $dept = $students
                ->getApplications()
                ->with('department')
                ->with('student')
                ->asArray()
                ->all();

        print_r($dept);
        //print_r($dept2);
        //print_r($dept3);

        echo "</pre>";
        die();
    }

}
