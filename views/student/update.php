<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<h3>Update Student Form</h3>

<?php
    if (Yii::$app->session->hasFlash('success')) {
        echo yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-success'
            ],
            'body' => Yii::$app->session->getFlash('success')
        ]);
    }
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'fieldConfig' => [
        'template' => "{label}\n{input}"
    ]
]); ?>

<?php if($studentModel->hasErrors()) : ?>
<?php
echo yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-danger'
            ],
            'body' => $form->errorSummary($studentModel)
        ]);
?>
<?php endif; ?>


<?= $form->field($studentModel, 'full_name') ?>
<?= $form->field($studentModel, 'ic_no')
        ->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '999999999999',
]); ?>

<?= $form->field($studentModel, 'email') ?>

<?= Html::submitButton("Update Student Record", [
    'class' => 'btn btn-primary'
]) ?>

<?php ActiveForm::end(); ?>


