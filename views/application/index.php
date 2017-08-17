<?php
/* @var $this yii\web\View */
use yii\bootstrap\Tabs;
?>
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

<?php
    if (Yii::$app->session->hasFlash('error')) {
        echo yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-danger'
            ],
            'body' => Yii::$app->session->getFlash('error')
        ]);
    }
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