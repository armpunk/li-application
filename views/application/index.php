<?php
/* @var $this yii\web\View */
use yii\bootstrap\Tabs;
?>
<?php

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Pending Applications',
            'content' => $this->render('_pending', [
                'pending_student' => $pending_student
            ]),
            'active' => true
        ],
        [
            'label' => 'Approved Applications',
            'content' => $this->render('_approved', [
                'approved_student' => $approved_student
            ]),
        ],
        [
            'label' => 'Rejected Applications',
            'content' => $this->render('_rejected', [
                'rejected_student' => $rejected_student
            ]),
        ],
        
    ],
]);