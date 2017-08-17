<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\grid\GridView;
?>
<br/>
<?php
echo GridView::widget([
    'dataProvider' => $approved_student,
    'columns' => [
        [
            'class' => 'yii\grid\DataColumn',
            'value' => function($model) {
                return $model->student->full_name;
            },
            'label' => 'Student Name',
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'value' => function($model) {
                return $model->department->name;
            },
            'label' => 'Department Applied',
        ],
        'date_applied:date',
        [
            'class' => 'yii\grid\DataColumn',
            'value' => function($model) {
                return ($model->getApprovedBy()->exists()) 
                ? $model->approvedBy->username 
                        : 'No Data';
            },
            'label' => 'Action Taken By',
        ],
    ]
]);
?>

