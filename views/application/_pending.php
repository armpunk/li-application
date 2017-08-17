<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\grid\GridView;
?>
<?php
echo GridView::widget([
    'dataProvider' => $pending_student,
]);
?>

    