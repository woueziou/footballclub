<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
?>

<div class="jumbotron row">

    <div class=" col-md-6">
<h3>Fraternity Football Club Membership App </h3>
<?= Html::img('@web/images/logo.png', ['alt'=>'FFC logo','height'=>'150px', 'width'=>'150px']);?>
</div>
<div class="site-signup col-md-6">
    <p>Please fill out the following fields to signup:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
</div>
