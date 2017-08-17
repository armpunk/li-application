<?php
/* @var $this yii\web\View */
use yii\bootstrap\Tabs;
?>
<?php

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Pending Applications',
            'content' => $this->render('_pending'),
            'active' => true
        ],
        [
            'label' => 'Approved Applications',
            'content' => $this->render('_approved'),
        ],
        [
            'label' => 'Rejected Applications',
            'content' => $this->render('_rejected'),
        ],
        
    ],
]);