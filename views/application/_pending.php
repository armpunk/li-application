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
    'dataProvider' => $pending_student,
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
            'class' => 'yii\grid\ActionColumn',
            'header' => '<span class="text-primary">Action</span>',
            'buttons' => [
                'view' => function($url, $data, $key) {
                    $string = '<span class="glyphicon glyphicon-eye-open" '
                            . 'aria-hidden="true"></span>';
                    return '';
                },
                        
                
            ]
        ]
    ]
]);
?>

    