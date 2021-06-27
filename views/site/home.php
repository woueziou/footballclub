<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Fraternity Football Club Membership ';


?>
<div class="jumbotron row">

    <div class=" col-md-6">
        <h3>Fraternity Football Club Membership App </h3>
        <?= Html::img('@web/images/logo.png', ['alt'=>'FFC logo','height'=>'150px', 'width'=>'150px']);?>
    </div>

    <div class="body-content col-md-6">
        <h3>Login to connect </h3>
        </br>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>


        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>


        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
        <div>
            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
        </div>


        <?php ActiveForm::end(); ?>

    </div>
</div>
