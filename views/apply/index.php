<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use dosamigos\selectize\SelectizeDropDownList;
use yii\helpers\ArrayHelper;
use app\models\Department;
use kartik\widgets\FileInput;
?>
<h3>LI Application Form</h3>

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
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]) ?>

<?= $form->field($studentModel, 'full_name') ?>
<?=
$form->field($studentModel, 'ic_no')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '999999999999',
]);
?>
<?= $form->field($studentModel, 'email') ?>

<div class="form-group">
    <label>Choose Preferred Department</label>
    <?php
    echo SelectizeDropDownList::widget([
        'name' => 'departments[]',
        'items' => ArrayHelper::map(Department::find()->all(), 'id', 'name'),
        'clientOptions' => [
            'maxItems' => 3
        ],
    ]);
    ?>
</div>

<div class="form-group">
    <label>Document Attachments (max 3 files)</label>
    <?=
    FileInput::widget([
        'model' => $uploadModel,
        'attribute' => 'attachmentFiles[]',
        'options' => [
            'multiple' => true,
            'accept' => '.docx, .pdf, .xlsx, .pptx'
        ],
        'pluginOptions' => [
            'maxFileCount' => 3,
            'allowedFileExtensions' => ['docx', 'pdf', 'xlsx', 'pptx']
        ]
    ])
    ?>  
</div>



<?= \yii\helpers\Html::submitButton('Submit Application', ['class' => 'btn btn-primary'])
?>

<?php ActiveForm::end() ?>
