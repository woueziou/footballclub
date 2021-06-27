<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AmountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Amounts';
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
<div class="amount-index row">
    <div class="col-md-12 card bg-light text-black ">
        <h1 class="h3 mb-0 text-gray-800">Payment Management</h1>
        </br>
        <ul class="list-inline">
            <li class="list-inline-item"><?= Html::a('Create Payment for a user', ['amount/create'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
        </ul>


    </div>
    </br>
    <div class="col-md-12">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'value',
            'tax',
            'create_at',
            'update_at',
            //'PAYMENT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

</div>
