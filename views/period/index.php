<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeriodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Periods';
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
    <div class="col-md-12 card bg-light text-black ">
        <h1 class="h3 mb-0 text-gray-800">Period Management</h1>
        </br>
        <ul class="list-inline">
            <li class="list-inline-item"><?= Html::a('Create Period', ['create'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
        </ul>


    </div>
    </br>


    <div class="period-index col-md-12">
        </br>
        <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'label',
            'comments',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

</div>
