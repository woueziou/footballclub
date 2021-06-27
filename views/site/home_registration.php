<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Fraternity Football Club Membership ';
?>
<div class="jumbotron row">

    <div class="col-md-6">
        <h3>Fraternity Football Club Membership App </h3>
        <?= Html::img('@web/images/logo.png', ['alt'=>'FFC logo','height'=>'150px', 'width'=>'150px']);?>
    </div>

    <div class="body-content col-md-6">
        <h3>Thank you for registration. An admin will approve before you can connect.</h3>

    </div>
</div>
