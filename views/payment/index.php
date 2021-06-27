<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
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
            <li class="list-inline-item"><?= Html::a('Completed Payments', ['payment'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Pending Payments', ['payment'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Process a Payment', ['payment'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>

        </ul>
    </div>
    </br>
    <div class="payment-index col-md-11">
        </br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'motif',
            'period',
            'user',
            'category',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
</div>