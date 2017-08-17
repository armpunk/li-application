<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h3>Student List</h3>

<?= Html::a("Add Student", Url::to(['/student/add-student']), ['class' => 'btn btn-primary pull-right'])
?>
<br/>
<br/>

<?php
echo GridView::widget([
    'dataProvider' => $studentsProvider,
    'columns' => [
        [
            'class' => 'yii\grid\DataColumn',
            'value' => function($data) {
                return $data->full_name . ' (' . $data->ic_no . ')';
            },
            'label' => 'Student Name',
            'attribute' => 'full_name'
        ],
        'created_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '<span class="text-primary">Action</span>',
            'buttons' => [
                'view' => function($url, $data, $key) {
                    $string = '<span class="glyphicon glyphicon-eye-open" '
                            . 'aria-hidden="true"></span>';
                    return Html::a($string, 
                            Url::to(['/student/view-student', 'id' => $data->id]));
                },
                        
                
            ]
        ]
    ]
]);
?>
