<?php

namespace app\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Application;

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

}
