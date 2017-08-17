<?php

namespace app\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Application;
use yii\helpers\Url;

class ApplicationController extends \yii\web\Controller {

    public function beforeAction($action) {
        parent::beforeAction($action);

        if (Yii::$app->user->isGuest) {
            $this->redirect(Url::to(['/user/login']));
            Yii::$app->response->send();
            return true;
        }
        return true;
    }

    public function actionIndex() {
        
        $pending_student = new ActiveDataProvider([
            'query' => Application::find()
                ->where(['status' => Application::APP_PENDING])
        ]);
        
        $approved_student = new ActiveDataProvider([
            'query' => Application::find()
                ->where(['status' => Application::APP_APPROVED])
        ]);
        
        $rejected_student = new ActiveDataProvider([
            'query' => Application::find()
                ->where(['status' => Application::APP_REJECTED])
        ]);
        
        return $this->render('index', [
            'pending_student' => $pending_student,
            'approved_student' => $approved_student,
            'rejected_student' => $rejected_student,
        ]);
    }
    
    public function actionApprove($id) {
        if (Yii::$app->request->isPost) {
            $application = Application::find()->where(['id' => $id])->one();
            $application->status = Application::APP_APPROVED;
            $application->approved_by = Yii::$app->user->id;
            
            if ($application->update()) {
                 Yii::$app->session->setFlash('success', 
                        'Application has been approved.');
                 
                 $this->redirect(Url::to(['/application/index']));
                 Yii::$app->response->send();
                 
            } else {
                 Yii::$app->session->setFlash('error', 
                        'Application approval error.');
                 
                 $this->redirect(Url::to(['/application/index']));
                 Yii::$app->response->send();
            }
        }
    }
    
    public function actionReject($id) {
        if (Yii::$app->request->isPost) {
            $application = Application::find()->where(['id' => $id])->one();
            $application->status = Application::APP_REJECTED;
            $application->approved_by = Yii::$app->user->id;
            
            if ($application->update()) {
                 Yii::$app->session->setFlash('success', 
                        'Application has been rejected.');
                 
                 $this->redirect(Url::to(['/application/index']));
                 Yii::$app->response->send();
                 
            } else {
                 Yii::$app->session->setFlash('error', 
                        'Application approval error.');
                 
                 $this->redirect(Url::to(['/application/index']));
                 Yii::$app->response->send();
            }
        }
    }

}
