<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MotifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Motifs';
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
<div class="motif-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Motif', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'label',
            'comments',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
