<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form col-md-6 ">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CATEGORY')->dropDownList(ArrayHelper::map(app\models\Category::find()->all(),'id','label'),['prompt'=>'Select User Category']) ?>

    <?= $form->field($model, 'ROLE')->dropDownList(ArrayHelper::map(app\models\Role::find()->all(),'id','label'),['prompt'=>'Select User Role']) ?>

    <?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(app\models\Status::find()->all(),'id','label'),['prompt'=>'Select User status']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

