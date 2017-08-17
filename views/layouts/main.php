<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;

\app\assets\AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= \yii\helpers\Html::csrfMetaTags() ?>
        <?php $this->head(); ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div style="
             background: url(https://www.dosm.gov.my/v1/images/header.png) no-repeat;
             background-size: cover;
             height: 100px;
             ">  

        </div>
        <?php
        NavBar::begin(['brandLabel' => 'LI Application']);

        $menu = [];

        if (Yii::$app->user->isGuest) {
            $menu = [
                ['label' => 'Home', 'url' => Url::home()],
                ['label' => 'Apply for LI', 'url' => Url::to(['/apply/index'])],
                ['label' => 'Check Application', 'url' => Url::to(['/apply/check'])],
                ['label' => 'Login', 'url' => Url::to(['/user/login'])]
            ];
        } else {
            $menu = [
                ['label' => 'Home', 'url' => Url::home()],
                ['label' => 'Student', 'url' => Url::to(['/student/index'])],
                ['label' => 'Department', 'url' => Url::to(['/department/index'])],
                ['label' => 'Application', 'url' => Url::to(['/application/index'])],
                [
                    'label' => 'Logout',
                    'url' => Url::to(['/user/logout']),
                    'linkOptions' => [
                        'data-method' => 'post'
                    ]
                ]
            ];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menu
        ]);

        NavBar::end();
        ?>
        <div class="container">
            <?php echo $content ?>
        </div>
        <br/>
        <br/>


        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage(); ?>
