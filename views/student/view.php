<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\widgets\DetailView; 
?>

<h3>Student Information <small><?php echo $student->full_name ?></small></h3>

<?php 
    echo DetailView::widget([
        'model' => $student,
        'attributes' => ['full_name', 'ic_no', 'email']
     ]);
?>





