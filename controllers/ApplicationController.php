<?php

namespace app\controllers;

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
        return $this->render('index');
    }

}
