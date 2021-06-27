<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = 'Create Payment';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
$role = $session->get('userRole');
if ($role == 2)
{
    $this->context->layout = 'main-user';
}
else
{
    $this->context->layout = 'main';
}
?>
<div class="row">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-12 card bg-light text-black ">
        <h1 class="h3 mb-0 text-gray-800">Payments Management</h1>
        </br>
        <ul class="list-inline">
            <li class="list-inline-item"><?= Html::a('Create Payment', ['create'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Completed Payments', ['completed'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Pending Payments', ['pending'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Process a Payment', ['process'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>

        </ul>
    </div>
    </br>
    <div class="payment-create col-md-12">
    </br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
