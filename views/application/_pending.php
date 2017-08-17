<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
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
            'template' => '{approve} {reject}',
            'buttons' => [
                'approve' => function($url, $data, $key) {
                    return Html::a('Approve', 
                            Url::to(['/application/approve', 'id' => $data->id]), [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => 'Are you sure you want to approve '
                                    . $data->student->full_name . ' for taking LI at ' .
                                    $data->department->name . '?',
                                    'method' => 'post'
                                ]
                    ]);
                },
                'reject' => function($url, $data, $key) {
                    return Html::a('Reject', 
                            Url::to(['/application/reject', 'id' => $data->id]), [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to reject '
                                    . $data->student->full_name . ' for taking LI at ' .
                                    $data->department->name . '?',
                                    'method' => 'post'
                                ]
                    ]);
                },
            ]
        ]
    ]
]);
?>

