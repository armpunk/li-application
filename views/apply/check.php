<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\bootstrap\ActiveForm;
?>

<h3 class="text-center">Check Application Status</h3>
<br/>

<?php if (is_null($applicationModel)) : ?>
    <?php if (is_null($student)) : ?>
        <?php
        echo yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-danger'
            ],
            'body' => "There is no student with that IC"
        ]);
        ?>
    <?php else : ?>
        <?php if ($hasApplication) : ?>
            <?php
            $form = ActiveForm::begin([
                        'method' => 'get',
                        'action' => yii\helpers\Url::to(['/apply/check'])
            ]);
            ?>

            <?= $form->field($student, 'ic_no')->input('text', ['name' => 'ic_no']) ?>
            <?= \yii\helpers\Html::submitButton('Check Application', [
                'class' => 'btn btn-primary'
            ]) ?>

            <?php ActiveForm::end() ?>
        <?php else : ?>
            <?php
            echo yii\bootstrap\Alert::widget([
                'options' => [
                    'class' => 'alert-danger'
                ],
                'body' => "There is no application for this IC number."
            ]);
            ?>
        <?php endif; ?>
    <?php endif; ?>

<?php else: ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Application Status</h3>
        </div>
        <div class="panel-body">
            <p>Your application status:</p>
                <?php foreach ($applicationModel as $application) : ?>
                <li>
                    <strong><?= $application->department->name ?></strong>
                    (<?= ($application->status == 0) ? "Pending" : "In Process" ?>)
                </li>
    <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>








