<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form col-md-4">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'motif')->dropDownList(ArrayHelper::map(app\models\Motif::find()->all(),'id','label'),['prompt'=>'Select Motif']) ?>
    <?= $form->field($model, 'period')->dropDownList(ArrayHelper::map(app\models\Period::find()->all(),'id','label'),['prompt'=>'Select Period']) ?>
    <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(app\models\Category::find()->all(),'id','label'),['prompt'=>'Select Members']) ?>
    <?= $form->field($model, 'amountvalue')->textInput(array('maxlength'=>13,'style'=>'text-align:right')) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

